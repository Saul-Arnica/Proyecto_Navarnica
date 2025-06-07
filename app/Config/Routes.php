<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Rutas de vistas
$routes->get('/', 'Home::index');
$routes->get('/quienesSomos', 'Home::quienesSomos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacionContacto', 'Home::informacionContacto');
$routes->get('/terminosYUsos', 'Home::terminosYUsos');
$routes->get('/catalogoProductos', 'Home::catalogoProductos');
$routes->get('/consultas', 'Home::consultas');


$routes->get('/mascotas', 'Home::productosPorCategoria');
$routes->get('/campo', 'Home::productosPorCategoria');
$routes->get('/insumos', 'Home::productosPorCategoria');
$routes->get('/servicios', 'Home::productosPorCategoria');


$routes->get('/productos', 'Home::productosPorCategoria');

//Rutas para los productos

//Rutas para inicio de sesión

//Rutas de contacto
$routes->post('informacionContacto/enviar', 'Contacto::enviar');

