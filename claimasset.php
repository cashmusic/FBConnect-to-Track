<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

require_once('config.php');
$okaytodownload = false;
session_start();

if (isset($_GET['approot'])) {
	$returnurl = $_GET['approot'];
} else {
	$returnurl = '/';
}

if ($_SESSION['fb_reports_liked']) {
	redirectToAsset();
} else {
	if ($_SESSION['fb_reports_liked'] !== false) {
		require_once('./lib/facebook.php');

		// initialize the facebook API with your application API Key and Secret
		$facebook = new Facebook(array(
			'appId'  => FACEBOOK_APPID,
			'secret' => FACEBOOK_SECRET,
			'cookie' => true
		));

		$session = $facebook->getSession();
		$fb_user = $session['uid'];

		try {
			$testLikeStatus = $facebook->api(array(
				'method' => 'pages.isfan',
				'uid' => $fb_user,
				'page_id' => FACEBOOK_FANPAGE_ID
			));
			if ($testLikeStatus) {
				redirectToAsset();
			} else {
				header('Location: '.$returnurl.'?logout=1');
			}
		} catch (FacebookApiException $e) {
			echo "There seems to be an error on the Facebook servers.";
		} 
	}
}

function redirectToAsset() {
	if (SECURE_DOWNLOAD) { 
		// use S3 secured download:
		require_once('./lib/S3.php');
		if (!defined('AMAZONS3_KEY') || !defined('AMAZONS3_SECRET')) {
			header('Location: ./'); 
		}
		$s3 = new S3(AMAZONS3_KEY, AMAZONS3_SECRET);
		header("Location: " . S3::getAuthenticatedURL(AMAZONS3_BUCKET, DOWNLOAD_URI, 120));
	} else {
		// simple redirect:
		header('Location: ' . DOWNLOAD_URI);
	}
}
?>