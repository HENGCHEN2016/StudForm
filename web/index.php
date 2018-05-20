<?php
/**
 * System: PHP 7.1
 * Code guidelines: PSR-1, PSR-2
 *
 * FRONT CONTROLLER - Responsible for URL routing and User Authentication
 *
 **/
date_default_timezone_set('Pacific/Auckland');

require __DIR__ . '/vendor/autoload.php';

use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;

define('APP_ROOT', __DIR__);

$collection = new RouteCollection();

$collection->attachRoute(
    new Route(
        '/index/', array(
            '_controller' => 'studentform\controller\AccountController::indexAction',
            'methods' => 'GET',
            'name' => 'accountIndex'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/account/signup', array(
            '_controller' => 'studentform\controller\AccountController::signupAction',
            'methods' => 'GET',
            'name' => 'accountSignup'
        )
    )
);
$collection->attachRoute(
    new Route(
        '/account/create', array(
            '_controller' => 'studentform\controller\AccountController::createAction',
            'methods' => 'POST',
            'name' => 'accountCreate'
        )
    )
);
$router = new Router($collection);
$router->setBasePath('/');

$route = $router->matchCurrentRequest();

// If route was dispatched successfully - return
if ($route) {
    // true indicates to webserver that the route was successfully served
    return true;
}

// Otherwise check if the request is for a static resource
$info = parse_url($_SERVER['REQUEST_URI']);
// check if its allowed static resource type and that the file exists
if (preg_match('/\.(?:png|jpg|jpeg|css|js)$/', "$info[path]")
    && file_exists("./$info[path]")
) {
    // false indicates to web server that the route is for a static file - fetch it and return to client
    return false;
} else {
    header("HTTP/1.0 404 Not Found");
    // Custom error page
    // require 'static/html/404.html';
    return true;
}