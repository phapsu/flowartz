<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

//Flowartz overrides

//user profile routes
$route['user/profile/edit'] = "user/edit";
$route['user/profile/edit/profile_picture'] = "user/edit_profile_picture";
$route['user/profile/edit/settings'] = "user/edit_settings";
$route['user/profile/edit/images'] = "user/edit_images";
$route['user/profile/edit/videos'] = $route['user/profile/edit/videos/(:num)'] = "user/edit_videos/$1";
$route['user/profile/edit/experience'] = $route['user/profile/edit/experience/(:num)'] = "user/edit_experience/$1";
$route['user/profile/edit/skills'] = $route['user/profile/edit/skills/(:num)'] = "user/edit_skills/$1";
$route['user/profile/edit/links'] = $route['user/profile/edit/links/(:num)'] = "user/edit_links/$1";

//misc. user routes
$route['user/(:num)/:any'] = "user/index/$1";
$route['user/activate/(:any)'] = "user/activate/$1";
$route['user/reset_password/(:any)'] = "user/reset_password/$1";

//search routes
//$route['search/(:any)'] = "search/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */