<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

if (isset($_GET['approot'])) {
	$returnurl = $_GET['approot'];
} else {
	$returnurl = '/';
}
if (isset($_GET['uid'])) {
	require_once('config.php');
	require_once('./lib/facebook.php');
	
	$okaytodownload = false;
	
	// initialize the facebook API with your application API Key and Secret
	$facebook = new Facebook(FACEBOOK_KEY,FACEBOOK_SECRET);
	$fb_user = (string) $_GET['uid'];
	if ($facebook->api_client->pages_isFan(FACEBOOK_FANPAGE_ID, $fb_user)) {
		if (SECURE_DOWNLOAD) { 
			// use S3 secured download:
			require_once('./lib/S3.php');
			if (!defined('AMAZONS3_KEY') || !defined('AMAZONS3_SECRET')) {
				header('Location: '.$returnurl); 
			}
			$s3 = new S3(AMAZONS3_KEY, AMAZONS3_SECRET);
			header("Location: " . S3::getAuthenticatedURL(AMAZONS3_BUCKET, DOWNLOAD_URI, 120));
		} else {
			// simple redirect:
			header('Location: ' . DOWNLOAD_URI);
		}
	} else {
		header('Location: '.$returnurl);
	}
} else {
	header('Location: '.$returnurl);
}
?>