<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/vehiculos', 'Vehiculo::index');
$routes->get('/list', 'Vehiculo::listado');
$routes->post('/save_vehiculo', 'Vehiculo::saveVehiculo');
$routes->post('/vehiculoById', 'Vehiculo::getVehiculoById');
$routes->post('/delete_vehiculo', 'Vehiculo::updateVehiculo');
$routes->get('get_contacto/(:num)', 'Vehiculo::getContacto/$1');
