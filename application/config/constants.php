<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// TRUE when the request is served on the live domain (lessnerplumbing.com or any subdomain).
// FALSE on localhost, staging, or when running from CLI — drives credential selection in
// database.php, email.php, and the TOMAIL routing below.
define('IS_LIVE', isset($_SERVER['HTTP_HOST']) && preg_match('/(^|\.)lessnerplumbing\.com$/i', $_SERVER['HTTP_HOST']));

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

if (IS_LIVE) {
	// Production keys — registered to lessnerplumbing.com
	define('GOOGLESITEKEY','6Le0_0kUAAAAANbl3sY-AygdC5VVARu5lDVYEMTK');
	define('GOOGLESECRETKEY','6Le0_0kUAAAAAHADXEMBNNGFtVwoiz1Cprer5_rV');
} else {
	// Google's public reCAPTCHA test keys — work on any domain (incl. localhost) and always verify successfully.
	// See https://developers.google.com/recaptcha/docs/faq
	define('GOOGLESITEKEY','6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI');
	define('GOOGLESECRETKEY','6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe');
}

define('PWD','lppwd');
if (IS_LIVE) {
	define('ADMINEMAIL','admin@lessnerplumbing.com');
} else {
	define('ADMINEMAIL','test@icwares.com');
}
//define('TOMAIL','admin@lessnerplumbing.com');
if( $_SERVER['REMOTE_ADDR'] == '59.90.28.106' ){ 
	define('TOMAIL','test@icwares.com');
}else{
	define('TOMAIL','kirsten@lessnerplumbing.com');
}

define('PAGE_LIMIT',10);
define('ADMIN','lpadmin');//for admin url
define('TITLE','LessnerPlumbing : ');
define('INDEXTITLE','LessnerPlumbing');
define('PAGELIMIT',7);


/*  fb and twittter feeds*/
define('fburlFeeds','https://graph.facebook.com/148091818575094/feed?access_token=680793655332996|J5OtYXt2_99eZOGaDzRd22SzvcE&limit=5&date_format=U');
/*  fb and twittter feeds*/
