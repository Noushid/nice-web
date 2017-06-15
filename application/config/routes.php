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
$route['default_controller'] = 'Home';
$route['login'] = 'Home/login';

/****HOME ROUTES START******/

$route['home'] = 'Home/index';
$route['about'] = 'Home/about';
$route['team'] = 'Home/team';
$route['services'] = 'Home/service';
$route['moments'] = 'Home/moments';
$route['blog'] = 'Home/blog';
$route['blogView/(:num)'] = 'Home/blogView/$1';
$route['contact'] = 'Home/contact';
$route['subscribe'] = 'Home/subscribe';
$route['request-quote'] = 'Home/request_quote';
$route['appointment-request'] = 'Home/appointment_request';
$route['contact-request'] = 'Home/contact_request';




$route['test'] = 'Home/test';
/****HOME ROUTES END******/

/****ADMIN******/
$route['admin'] = 'Dashboard';
$route['login/verify'] = 'Dashboard/verify';
$route['logout'] = 'Dashboard/logout';
$route['admin/check-thumb'] = 'Dashboard/thumbnail_check';
$route['admin/user'] = 'Dashboard/get_user';

$route['admin/change'] = 'Dashboard/change_profile';
$route['admin/change/submit'] = 'Dashboard/edit_profile';

/*NEWS*/
$route['admin/news'] = 'Dashboard/news';
$route['admin/news/get-all'] = 'News_Controller/get_all';
$route['admin/news/add'] = 'News_Controller/store';
$route['admin/news/edit/(:num)'] = 'News_Controller/update/$1';
$route['admin/news/upload'] = 'News_Controller/upload';
$route['admin/news/delete-image/(:num)'] = 'News_Controller/delete_image/$1';
$route['admin/news/delete/(:num)'] = 'News_Controller/delete/$1';

/*BROCHURE*/
$route['admin/brochures'] = 'Dashboard/brochure';
$route['admin/brochure/get-all'] = 'Brochure_Controller/get_all';
$route['admin/brochure/add'] = 'Brochure_Controller/store';
$route['admin/brochure/edit/(:num)'] = 'Brochure_Controller/update/$1';
$route['admin/brochure/upload'] = 'Brochure_Controller/upload';
$route['admin/brochure/delete-image/(:num)'] = 'Brochure_Controller/delete_image/$1';
$route['admin/brochure/delete/(:num)'] = 'Brochure_Controller/delete/$1';

/*HELPFUL-LINKS*/
$route['admin/helpful-links'] = 'Dashboard/helpful_link';
$route['admin/helpful-link/get-all'] = 'Helpful_Link_Controller/get_all';
$route['admin/helpful-link/add'] = 'Helpful_Link_Controller/store';
$route['admin/helpful-link/edit/(:num)'] = 'Helpful_Link_Controller/update/$1';
$route['admin/helpful-link/delete/(:num)'] = 'Helpful_Link_Controller/delete/$1';

/*GALLERY*/
$route['admin/gallery'] = 'Dashboard/gallery';
$route['admin/gallery/get-all'] = 'Gallery_Controller/get_all';
$route['admin/gallery/add'] = 'Gallery_Controller/store';
$route['admin/gallery/edit/(:num)'] = 'Gallery_Controller/update/$1';
$route['admin/gallery/upload'] = 'Gallery_Controller/upload';
$route['admin/gallery/delete-image/(:num)'] = 'Gallery_Controller/delete_image/$1';
$route['admin/gallery/delete/(:num)'] = 'Gallery_Controller/delete/$1';


/*SLIDE IMAGE*/
$route['admin/slide-images'] = 'Dashboard/slide_image';
$route['admin/slide-images/get-all'] = 'Slide_Image_Controller/get_all';
$route['admin/slide-images/upload'] = 'Slide_Image_Controller/upload';
$route['admin/slide-images/add'] = 'Slide_Image_Controller/store';
$route['admin/slide-images/delete/(:num)'] = 'Slide_Image_Controller/delete/$1';

/*BLOG*/
$route['admin/blog'] = 'Dashboard/blog';
$route['admin/blog/get-all'] = 'Blog_Controller/get_all';
$route['admin/blog/add'] = 'Blog_Controller/store';
$route['admin/blog/edit/(:num)'] = 'Blog_Controller/update/$1';
$route['admin/blog/upload'] = 'Blog_Controller/upload';
$route['admin/blog/delete-image/(:num)'] = 'Blog_Controller/delete_image/$1';
$route['admin/blog/delete/(:num)'] = 'Blog_Controller/delete/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
