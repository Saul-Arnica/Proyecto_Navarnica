<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/quienesSomos', 'Home::quienes_Somos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacion_contacto', 'Home::informacion_Contacto');
$routes->get('/terminos_y_usos', 'Home::terminos_Y_Usos');
$routes->get('/catalogo_productos', 'Home::catalogo_Productos');
$routes->get('/consultas', 'Home::consultas');
