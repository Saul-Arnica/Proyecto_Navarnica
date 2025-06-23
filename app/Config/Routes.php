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


//Rutas de registro
$routes->post('/registro', 'Usuario::registroCliente');
$routes->get('/registro', 'Home::registro');
//Ruta para dar de baja un usuario
$routes->get('/bajaUsuario', 'Usuario::bajaUsuario');



//$routes->get('/admin/gestion', 'Administrador::gestion');

// Rutas de las categorías
$routes->get('/productosPorCategoria', 'Home::productosPorCategoria');
$routes->get('/producto', 'Home::producto');

//$routes->get('/productos', 'Home::productosPorCategoria');

//Rutas para los productos
$routes->post('api/filtrar-productos', 'Productos::filtrarProductosAjax');

//Rutas para inicio de sesión
$routes->match(['get', 'post'], '/login', 'InicioSesion::login');
$routes->get('/recuperar', 'Home::estamosTrabajando');

$routes->post('/logout', 'InicioSesion::logout');
$routes->get('/logout', 'InicioSesion::logout');

//Rutas de contacto
$routes->post('informacionContacto/enviar', 'Contacto::enviar');

// Rutas de Gestion
$routes->get('gestion', 'Gestion::productos');
$routes->get('gestion/productos', 'Gestion::productos');
$routes->get('gestion/categorias', 'Gestion::categorias');
$routes->get('gestion/usuarios', 'Gestion::usuarios');
$routes->get('gestion/consultas', 'Gestion::consultas');

$routes->get('gestion/altaUsuario', 'Gestion::altaUsuario');
$routes->post('gestion/altaUsuario', 'Usuario::altaUsuario');

$routes->get('gestion/altaCategoria', 'Gestion::altaCategoria');
$routes->post('gestion/altaCategoria', 'Categorias::altaCategoria');

$routes->get('gestion/altaProducto', 'Gestion::altaProducto');
$routes->post('gestion/altaProducto', 'Productos::altaProducto');