<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

// Register Router
$route['register'] = 'user/register';
$route['register/submit'] = 'user/register/form_submit';

// Login Router
$route['login'] = 'auth/login';
$route['login/submit'] = 'auth/login/form_submit';

// Logout Router
$route['logout'] = 'auth/logout';

// Product Router
$route['product/(:num)'] = 'product/product/detail/$1';
$route['product/add-to-cart'] = 'product/product/add_to_cart';
$route['cart'] = 'product/product/cart_page';
$route['remove-product-from-cart/(:num)'] = 'product/product/remove_product_from_cart/$1';

// Transaction Router
$route['transaction/precheckout'] = 'transaction/transaction/pre_checkout';
$route['transaction/checkout'] = 'transaction/transaction/checkout';
$route['transaction/history'] = 'transaction/transaction/history_page';
$route['transaction/detail/(:num)'] = 'transaction/transaction/detail/$1';
$route['transaction/upload/(:num)'] = 'transaction/transaction/upload_payment/$1';

// Profile Router
$route['user/profile'] = 'user/profile';
$route['user/edit-profile'] = 'user/profile/edit_prof_submit';
$route['user/ubah-password'] = 'user/profile/ubah_password';

// Address Router
$route['address/list-address'] = 'address/address';

// Rating Router
$route['rating/submit'] = 'rating/rating/submit_review';
$route['rating/list'] = 'rating/rating/list_review';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
