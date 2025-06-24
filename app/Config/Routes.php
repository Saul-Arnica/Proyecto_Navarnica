<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas públicas
$routes->get('/', 'Home::index');
$routes->get('/quienesSomos', 'Home::quienesSomos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacionContacto', 'Home::informacionContacto');
$routes->get('/terminosYUsos', 'Home::terminosYUsos');
$routes->get('/catalogoProductos', 'Home::catalogoProductos');
$routes->get('/consultas', 'Home::consultas');

// Registro e inicio de sesión
$routes->get('/registro', 'Home::registro');
$routes->post('/registro', 'Usuario::registroCliente');
$routes->match(['get', 'post'], '/login', 'InicioSesion::login');
$routes->get('/recuperar', 'Home::estamosTrabajando');
$routes->get('/logout', 'InicioSesion::logout');
$routes->post('/logout', 'InicioSesion::logout');

// Contacto
$routes->post('informacionContacto/enviar', 'Consulta::altaConsulta');
$routes->get('/gestion/respuestaConsulta/(:num)', 'Consulta::respuestaConsulta/$1');
$routes->post('/gestion/respuestaConsulta/(:num)', 'Consulta::respuestaConsulta/$1');
$routes->post('/gestion/eliminarConsulta/(:num)', 'Consulta::bajaConsulta/$1');

// Productos (vista pública)
$routes->get('/productosPorCategoria', 'Home::productosPorCategoria');
$routes->get('/producto', 'Home::producto');
$routes->post('api/filtrar-productos', 'Productos::filtrarProductosAjax');

// ===========================
//         GESTIÓN
// ===========================

// Panel principal
$routes->get('gestion', 'Gestion::productos');
$routes->get('gestion/productos', 'Gestion::productos');
$routes->get('gestion/usuarios', 'Gestion::usuarios');
$routes->get('gestion/categorias', 'Gestion::categorias');
$routes->get('gestion/consultas', 'Gestion::consultas');

// === Usuarios ===
$routes->get('gestion/altaUsuario', 'Gestion::altaUsuario');
$routes->post('gestion/altaUsuario', 'Usuario::altaUsuario');
$routes->get('gestion/editarUsuario', 'Gestion::editarUsuario');
$routes->post('gestion/editarUsuario', 'Usuario::modificarUsuario');
$routes->post('gestion/bajaUsuario/(:num)', 'Usuario::bajaUsuario/$1');

// === Productos ===
$routes->get('gestion/altaProducto', 'Gestion::altaProducto');
$routes->post('gestion/altaProducto', 'Productos::altaProducto');
$routes->get('gestion/editarProducto', 'Gestion::editarProducto');
$routes->post('gestion/editarProducto', 'Productos::modificacionProducto');
$routes->post('gestion/bajaProducto/(:num)', 'Productos::bajaProducto/$1');

// === Categorías ===
$routes->get('gestion/altaCategoria', 'Gestion::altaCategoria');
$routes->post('gestion/altaCategoria', 'Categorias::altaCategoria');
$routes->get('gestion/editarCategoria', 'Gestion::editarCategoria');
$routes->post('gestion/editarCategoria', 'Categorias::modificarCategoria');
$routes->post('gestion/eliminarCategoria/(:num)', 'Categorias::bajaCategoria/$1');

// === Consultas ===
$routes->get('gestion/editarConsulta', 'Gestion::editarConsulta');
$routes->post('gestion/editarConsulta', 'Consultas::modificarConsulta');
$routes->post('gestion/bajaConsulta/(:num)', 'Consultas::bajaConsulta/$1');


// === Carrito ===
$routes->get('/carrito', 'Home::carrito');
$routes->post('/carrito/agregar', 'Carrito::agregar');
$routes->get('/carrito/eliminar/(:num)', 'Carrito::eliminar/$1');
$routes->get('/carrito/vaciar', 'Carrito::vaciar');
$routes->get('/carrito/finalizar', 'Carrito::finalizar');

// === Mis Compras ===
$routes->get('/misCompras', 'Ventas::misCompras');