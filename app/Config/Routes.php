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
$routes->get('/login', 'Home::login');

$routes->get('/admin/gestion', 'Administrador::gestion');

// Rutas de las categorías
$routes->get('/productosPorCategoria', 'Home::productosPorCategoria');
$routes->get('/producto', 'Home::producto');

//$routes->get('/productos', 'Home::productosPorCategoria');

//Rutas para los productos
$routes->post('api/filtrar-productos', 'Productos::filtrarProductosAjax');

//Rutas para inicio de sesión
$routes->match(['get', 'post'], '/login', 'InicioSesion::login');

$routes->post('/logout', 'InicioSesion::logout');
$routes->get('/logout', 'InicioSesion::logout');

//Rutas de contacto
$routes->post('informacionContacto/enviar', 'Contacto::enviar');