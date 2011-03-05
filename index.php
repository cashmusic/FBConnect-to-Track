<?php 
require_once('includes/head.php'); 
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

<?php 
	if ($on_facebook) { 
		require_once('includes/script_fb.php'); 
		echo '<link href="assets/css/fb.css" rel="stylesheet" type="text/css" />'; 
	} else {
		require_once('includes/script_main.php'); 
		echo '<link href="assets/css/main.css" rel="stylesheet" type="text/css" />';
	} 
?>

</head> 
<body> 

	<div id="fb-root"></div>
	<div id="mainspc"> 

		<h2>FBConnect To A Track— Or Code</h2>
		<p style="margin-bottom:40px;">
		This page uses Facebook's API to give a free download to fans of our
		Facebook page. All you need to do is be a fan of <a href="http://www.facebook.com/cashmusic.org">CASH Music on Facebook</a> 
		for a free download of the code that powers this demo. You can even use the fanbox below to become a fan.
		</p>

		<?php require_once('includes/render_components.php'); ?>

		<div class="clearall">.</div>
	</div> 
 
</body> 
</html>