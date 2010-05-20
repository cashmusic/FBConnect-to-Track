<?php 
require_once('config.php'); 
$currenturl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
<title>CASH Music</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="<?php echo FACEBOOK_SHARE_TITLE; ?>" />
<meta name="description" content="<?php echo FACEBOOK_SHARE_DESCRIPTION; ?>" />
<link rel="image_src" href="<?php echo FACEBOOK_SHARE_IMAGE; ?>" / >
<link rel="icon" type="image/png" href="http://cashmusic.org/images/icons/cash.png" /> 
 
<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js" type="text/javascript"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
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
	
	FB.getLoginStatus(handleAPIResponse);
	
	// view the page with ?logout=1 to reset authorization
	<?php if (isset($_GET['logout'])) { ?>
	(function(){
		FB.api({ method: 'Auth.revokeAuthorization' }, function(response) {resetMessage();});
		FB.logout(handleAPIResponse);
	}).delay(3000);
	<?php } ?>
	
	function addLoginEvent() {
		$('login').addEvent('click', function(e) {
			FB.login(handleAPIResponse);
			e.stop();
		});
	}
	
	// no user, clear display
	function resetMessage() {
		document.id('fb-message').set('html',
			'<p><?php echo str_replace("'","\'",WELCOME_MESSAGE); ?></p>'+
			'<a href="#" id="login" class="biglink">Connect to Facebook</a>'+
			'<p class="smallmessage">verify you are a fan and unlock your download</p>'
		);
		addLoginEvent();	
	}
	
	// handle a session response from any of the auth related calls
	function handleAPIResponse(response) {
		if (!response.session) {
			resetMessage();
			return;
		}
	
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
					var poplocation = document.id('fbsharelink').getProperty('href');
					e.stop();
					window.open(poplocation,'cui_external','width=760,height=400,scrollbars=yes,resizable=yes,location=no,directories=no,status=no'); 
				});
			} else {
				document.id('fb-message').set('html',
					'<p><?php echo str_replace("'","\'",NOTAFAN_MESSAGE); ?></p>'+
					'<a href="#" id="login" class="biglink">Connect to Facebook</a>'+
					'<p class="smallmessage">verify you are a fan and unlock your download</p>'
				);
				addLoginEvent();
			}
		});
	}

	FB.XFBML.parse()
});

//]]> 
</script>

<link href="assets/css/main.css" rel="stylesheet" type="text/css" /> 
 
</head> 
<body> 
 
<div id="wrap"> 
	<div id="cash_sitelogo"><a href="http://cashmusic.org/"><img src="assets/images/cash.png" alt="CASH Music" width="30" height="30" /></a></div> 
	<div id="mainspc"> 
	
		<h2>FBConnect To A Track— Or Code</h2>
		<p style="margin-bottom:40px;">
		This page uses Facebook's API to give a free download to fans of our
		Facebook page. All you need to do is be a fan of <a href="http://www.facebook.com/cashmusic.org">CASH Music on Facebook</a> 
		for a free download of the code that powers this demo. You can even use the fanbox below to become a fan.
		</p>
		
		<div class="oneoftwo" style="margin:-10px 0 0 -10px;">
			<fb:like-box profile_id="<?php echo FACEBOOK_FANPAGE_ID; ?>" width="300" stream="0" header="0" connections="0" logobar="0"></fb:like-box>
    	</div>
		
		<div class="oneoftwo lastone">
			<div id="fb-message"></div>
		</div>
		
		
		<div id="fb-root"></div>
		
		<div style="clear:both;height:1px;overflow:hidden;visibility:hidden;">.</div>
		<br /><br /><br /><br /><br /> 
 		<p style="font-size:0.85em;color:#aaa;"> 
 		And if you don't feel like being a fan, you can just <a href="http://github.com/cashmusic/FBConnect-to-Track" style="color:#5aa2f1;">download it from GitHub</a>.
 		</p>
		
 
	</div> 
</div> 
 
</body> 
</html>