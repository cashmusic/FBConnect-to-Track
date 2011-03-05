<script type="text/javascript">
//<![CDATA[ 

window.addEvent('domready', function() {	
	if (FB) {
		document.id('fb-message').set('html','');
	}
	
	// initialize the library with your API key
	// important: do NOT show your API secret here or anywhere in this script
	FB.init({ 
		appId: '<?php echo FACEBOOK_APPID; ?>',
		cookie: true 
	});
	
	FB.getLoginStatus(handleLoginResponse);
	
	FB.Event.subscribe('edge.create',setMessage);
	FB.Event.subscribe('edge.remove',setMessage);
	
	// view the page with ?logout=1 to reset authorization
	<?php if (isset($_GET['logout'])) { ?>
	(function(){
		FB.api({ method: 'Auth.revokeAuthorization' }, function(response) {resetMessage();});
		FB.logout(handleAPIResponse);
	}).delay(3000);
	<?php } ?>
	
	// handle a session response from any of the auth related calls
	function handleLoginResponse(response) {
		if (!response.session) {
			resetMessage();
			return;
		} else {
			setMessage();
		}
	}
	
	// no user, clear display
	function resetMessage() {
		document.id('fb-message').set('html',
			'<p><?php echo str_replace("'","\'",WELCOME_MESSAGE); ?></p>'+
			'<a href="#" id="login" class="biglink">Connect to Facebook</a>'+
			'<p class="smallmessage">verify you are a fan and unlock your download</p>'
		);
		$('login').addEvent('click', function(e) {
			FB.login(handleLoginResponse);
			e.stop();
		});
	}
	
	function setMessage() {
		FB.api({
			method: 'pages.isFan',
			uid: FB.getSession().uid,
			page_id: <?php echo FACEBOOK_FANPAGE_ID; ?>
		}, 
		function(response) {
			if (response) {
				document.id('fb-message').set('html',
					'<p><?php echo str_replace("'","\'",ISAFAN_MESSAGE); ?></p>'+
					'<a href="claimasset.php?approot=<?php echo $currenturl; ?>" class="biglink"><?php echo DOWNLOAD_TITLE; ?></a>'+
					'<p class="smallmessage">'+
 					'<br />Enjoy it, and <a id="fbsharelink" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($currenturl) ?>">please share</a>!</p>'
				);
				document.id('fbsharelink').addEvent('click', function(e){
					showFeedPost();
					e.stop();
				});
			} else {
				document.id('fb-message').set('html','<p><?php echo str_replace("'","\'",NOTAFAN_MESSAGE); ?></p>');
			}
		});
	}

	function showFeedPost() {
		FB.ui({
			method: 'feed',
			display: 'dialog',
			name: '<?php echo str_replace("'","\'",FACEBOOK_SHARE_TITLE); ?>',
			link: '<?php echo $currenturl ?>',
			picture: '<?php echo FACEBOOK_SHARE_IMAGE; ?>',
			description: '<?php echo str_replace("'","\'",FACEBOOK_SHARE_DESCRIPTION); ?>'
		});
	}

	FB.XFBML.parse()
});

//]]> 
</script>