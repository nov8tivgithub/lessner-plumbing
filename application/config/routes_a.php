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
$route['registration/(:any)'] = 'frontend/user/registration/$1';
$route['registration'] = 'frontend/user/registration';
$route['login'] = 'frontend/user/login';
$route['forgotpassword'] = 'frontend/user/forgotpassword';
$route['resetpassword/(:any)'] =  'frontend/user/resetpassword/$1';
$route['logout'] = 'frontend/user/logout';
$route['myprofile'] = 'frontend/user/myprofile';
$route['changepassword'] = 'frontend/user/changepassword';

$route['SomethingSavory'] =  'frontend/frontend/index/SomethingSavory';
$route['SomethingSweet'] =  'frontend/frontend/index/SomethingSweet';
$route['index/(:any)'] =  'frontend/frontend/index/$1';
$route['aboutus'] = 'frontend/frontend/aboutus';
$route['contactus'] = 'frontend/frontend/contactus';
$route['posts'] = 'frontend/frontend/posts';
$route['postdetails/(:any)'] = 'frontend/frontend/postdetails/$1';
$route['archives'] = 'frontend/frontend/archives';
$route['merchandise'] = 'frontend/frontend/merchandise';
$route['markets'] = 'frontend/frontend/markets';
$route['recipes'] = 'frontend/frontend/recipes';
$route['retailers'] = 'frontend/frontend/retailers';
$route['media'] = 'frontend/frontend/media';
$route['nutritionfacts'] = 'frontend/frontend/nutritionfacts';



$route['estore'] = 'frontend/cart/estore';
$route['estore/(:any)'] =  'frontend/cart/estore/$1';
$route['estoredetails/(:any)'] =  'frontend/cart/estoredetails/$1';
$route['cart'] = 'frontend/cart/cartdetails';
$route['paypal'] = 'frontend/payment/paypal';
$route['payment'] = 'frontend/payment/authorize';
$route['myreceipt'] = 'frontend/cart/myreceipt';
$route['paypalverify'] = 'frontend/payment/paypalcheck';
$route['receiptview/(:any)'] =  'frontend/cart/receiptview/$1';
$route['editpack/(:any)'] =  'frontend/cart/editpack/$1';
$route['otherflavors'] = 'frontend/cart/otheritems';
$route['otherflavors/(:any)'] =  'frontend/cart/otheritems/$1';
/*
frontend ends
*/


