<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/user/login', 'User::getLogin');
$routes->post('/user/login', 'User::postLogin');
$routes->get('/user/logout', 'User::logout');

$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/page/tos', 'Page::tos');

$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/kategori/(:any)', 'Artikel::index/$1');
$routes->get('/artikel/artikelterkini', 'Artikel::terkini');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});