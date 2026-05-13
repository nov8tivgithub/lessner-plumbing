<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

if (IS_LIVE) {
	// Production: live RDS
	$db['default']['hostname'] = 'iclivedbinstance.cwtxvqg3ca0c.us-east-1.rds.amazonaws.com';
	$db['default']['username'] = 'lpwebm_admin';
	$db['default']['password'] = 'aXYTjczhs3VyWEnjrwAE';
	$db['default']['database'] = 'lpwebm_lpdb';
} else {
	// Local / dev: XAMPP MySQL
    $db['default']['hostname'] = 'ic-demo-db-instance.cwtxvqg3ca0c.us-east-1.rds.amazonaws.com';
    $db['default']['username'] = 'icdemoadmin';
    $db['default']['password'] = 't8wQ{jMJu?PVXKVRkQ8HZHxHw';

	// $db['default']['hostname'] = '127.0.0.1';
	// $db['default']['username'] = 'root';
	// $db['default']['password'] = '';
	$db['default']['database'] = 'lessner_plumbing_dev';
}
$db['default']['dbdriver'] = 'mysqli';

$db['default']['dbprefix'] = 'lp_';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;