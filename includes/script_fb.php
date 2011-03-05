<script type="text/javascript">
//<![CDATA[ 

window.addEvent('domready', function() {		
	// initialize the library with your API key
	// important: do NOT show your API secret here or anywhere in this script
	FB.init({ 
		appId: '<?php echo FACEBOOK_APPID; ?>',
		cookie: true 
	});
	
	FB.Event.subscribe('edge.create',function() {
		window.location.reload();
	});
	
	if (document.id('fbsharelink')) {
		document.id('fbsharelink').addEvent('click', function(e){
			showFeedPost();
			e.stop();
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

	FB.XFBML.parse();
	FB.Canvas.setSize();
});

//]]> 
</script>