<?php 
$currenturl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if($_SERVER['SCRIPT_FILENAME'] == __FILE__) {
  header('Location: ' . $currenturl);
  exit;
}

require_once('config.php'); 

function parse_signed_request($signed_request, $secret) {
	list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

	// decode the data
	$sig = base64_url_decode($encoded_sig);
	$data = json_decode(base64_url_decode($payload), true);

	if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
		error_log('Unknown algorithm. Expected HMAC-SHA256');
		return null;
	}

	// check sig
	$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
	if ($sig !== $expected_sig) {
		error_log('Bad Signed JSON signature!');
		return null;
	}

	return $data;
}

function base64_url_decode($input) {
	return base64_decode(strtr($input, '-_', '+/'));
}

$on_facebook = false;
if (!empty($_POST['signed_request'])) {
	$on_facebook = true;
	$fb_signed_request = parse_signed_request($_POST['signed_request'],FACEBOOK_SECRET);
	if (!empty($fb_signed_request['page']['id'])) {
		$on_facebook_tab = true;
		session_start();
	}
}
?>