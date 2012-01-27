<?php

/**
 * @file
 * A single location to store configuration.
 */

// add your facebook credentials here
define('FACEBOOK_APPID', '217110845048257');
define('FACEBOOK_SECRET', 'b4bef4590ce7561fec25456d820de4c0');
define('FACEBOOK_FANPAGE_NAME', 'IAKOPO');
define('FACEBOOK_FANPAGE_ID', '137430189640744'); // click "edit this page" and see the id in the URL
define('FACEBOOK_FANPAGE_URL', 'http://www.facebook.com/IAKOPO'); 

// the messages shown to the visitor
// no double-quotes please, escape single quotes with \'
define('WELCOME_MESSAGE', 'Bless up! Click the "Connect to Facebook" link. Once you like mi page, you will get a link to the free download. Much love!');
define('ISAFAN_MESSAGE', 'Give thanks for the link! Click below for your free download:');
define('NOTAFAN_MESSAGE', 'You haven\'t liked mi page. Please click the like button and try again.');

// facebook share settings - this is what shows up when a user clicks to share
// no double-quotes please, escape single quotes with \'
define('FACEBOOK_SHARE_TITLE', 'IAKOPO - TOKYO PARTY Free Download');
define('FACEBOOK_SHARE_IMAGE', 'https://rapidshare.com/files/2538071801/TokyoParty_for_Facebook.jpg'); // absolute path 100x100
define('FACEBOOK_SHARE_DESCRIPTION', 'Bless Up! Get one of mi unofficial songs for free by liking my Facebook Artist Page. Much love!');

// set secure download to true (for S3 security) or false for straight http download
define('SECURE_DOWNLOAD', false);
// set amazon credentials if you are using a secure download
define('AMAZONS3_KEY', 'xxxxxxxxxxxxxxxxxxx');
define('AMAZONS3_SECRET', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
define('AMAZONS3_BUCKET', 'xxxxxxxxx');

// set your download title
// escape single quotes with \'
define('DOWNLOAD_TITLE', 'Iakopo - TOKYO PARTY');
// URL or amazon URI (if amazon, do not include bucket)
define('DOWNLOAD_URI', 'https://rapidshare.com/files/3855941462/Tokyo_PartyMaster01.mp3');
?>