<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

define('GOOGLESITEKEY','6Le0_0kUAAAAANbl3sY-AygdC5VVARu5lDVYEMTK');
define('GOOGLESECRETKEY','6Le0_0kUAAAAAHADXEMBNNGFtVwoiz1Cprer5_rV');

define('PWD','lppwd');
define('ADMINEMAIL','admin@lessnerplumbing.com');
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
