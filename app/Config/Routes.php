<?php namespace Config;

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Router\Route;

$routes->get('index', 'MainController::index'); // Remove the leading slash


$routes->match(['get', 'post'], 'upload', 'MainController::upload');
$routes->match(['get', 'post'], 'create-playlist', 'MainController::createPlaylist');
$routes->get('playlist', 'MainController::playlist');
$routes->get('playlist/show/(:num)', 'MainController::showPlaylist/$1');


$routes->match(['get', 'post'], 'add-to-playlist/(:num)/(:num)', 'MainController::addToPlaylist/$1/$2');
$routes->match(['get', 'post'], 'remove-from-playlist/(:num)/(:num)', 'MainController::removeFromPlaylist/$1/$2');
$routes->match(['get', 'post'], 'search', 'MainController::search');

$routes->get('playlist/edit/(:num)', 'MainController::editPlaylist/$1');
$routes->post('playlist/update/(:num)', 'MainController::updatePlaylist/$1');
$routes->get('playlist/delete/(:num)', 'MainController::deletePlaylist/$1');
$routes->post('music/search', 'MainController::search');
$routes->get('playlists/edit/(:num)', 'MainController::edit_track/$1');
$routes->post('playlist/update_tracks/(:num)', 'MainController::update_tracks/$1');

$routes->add('music/delete/(:num)', 'MainController::deleteTrack/$1');








