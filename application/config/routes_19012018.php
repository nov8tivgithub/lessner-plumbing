<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "frontend/frontend/index";
$route['404_override'] = '';
$route['404'] =  'frontend/frontend/pagenotfound';
$route['scripterror'] =  'browser/jcheck';

$route[ADMIN] = 'admin/admin/index';
$route[ADMIN.'/logout'] = 'admin/admin/logout';
$route[ADMIN.'/forgotpassword'] = 'admin/admin/forgotpassword';
$route[ADMIN.'/resetpassword/(:any)'] = 'admin/admin/resetpassword/$1';
/*
admin starts
*/
$route[ADMIN.'/adminmanager'] = 'admin/admin/adminmanager';
$route[ADMIN.'/adminmanager/(:any)/(:any)'] =  'admin/admin/adminmanager/$1/$2';
$route[ADMIN.'/adminmanager/(:any)'] =  'admin/admin/adminmanager/$1';
$route[ADMIN.'/changeadminstatus'] = 'admin/admin/changeadminstatus';
$route[ADMIN.'/createadmin'] = 'admin/admin/createadmin';
$route[ADMIN.'/editadmin/(:any)'] = 'admin/admin/editadmin/$1';
$route[ADMIN.'/changeadminpasswrd/(:any)/(:any)'] =  'admin/admin/changeadminpasswrd/$1/$2';
$route[ADMIN.'/myprofile'] =  'admin/admin/myprofile';
/*
admin ends
*/






/*
post starts
*/
$route[ADMIN.'/blogmanager'] = 'admin/posts/postmanager';
$route[ADMIN.'/blogmanager/(:any)/(:any)'] =  'admin/posts/postmanager/$1/$2';
$route[ADMIN.'/blogmanager/(:any)'] =  'admin/posts/postmanager/$1';
$route[ADMIN.'/changeblogstatus'] =  'admin/posts/changepoststatus';
$route[ADMIN.'/createblog'] =  'admin/posts/createpost';
$route[ADMIN.'/editblog/(:any)'] =  'admin/posts/editpost/$1';

$route[ADMIN.'/editcategory/(:any)'] =  'admin/posts/edittag/$1';
$route[ADMIN.'/categories'] = 'admin/posts/tags';
$route[ADMIN.'/categories/(:any)/(:any)'] =  'admin/posts/tags/$1/$2';
$route[ADMIN.'/categories/(:any)'] =  'admin/posts/tags/$1';
$route[ADMIN.'/changetagstatus'] =  'admin/posts/changetagstatus';

/*
post ends
/*

backend ends
*/

/*
frontend starts
*/

$route['index/(:any)'] =  'frontend/frontend/index/$1';
$route['posts'] = 'frontend/frontend/posts';
$route['postdetails/(:any)'] = 'frontend/frontend/postdetails/$1';
$route['archives'] = 'frontend/frontend/archives';


$route['aboutus'] = 'frontend/frontend/aboutus';
$route['contactus'] = 'frontend/frontend/contactus';
$route['home'] =  'frontend/frontend/index';
$route['blog'] =  'frontend/frontend/bloglist';
$route['blog/(:any)'] =  'frontend/frontend/bloglist/$1';
$route['blogdetails/(:any)'] =  'frontend/frontend/blogdetail/$1';
$route['home'] =  'frontend/frontend/index';
$route['blog'] =  'frontend/frontend/bloglist';

$route['service'] = 'frontend/frontend/service';
$route['servicearea'] = 'frontend/frontend/servicearea';
$route['polybutylenepipe'] =  'frontend/frontend/polybutylenepipe';
$route['draincleaning'] =  'frontend/frontend/draincleaning';

$route['plumber-(:any)'] =  'frontend/frontend/plumber/$1';
$route['gallery'] =  'frontend/frontend/gallery';
/*
frontend ends
*/


