<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\ErrorController;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();

/*************************LOGIN********************************* */

$router -> get('/', [LoginController::class, 'login']);
$router -> post('/', [LoginController::class, 'login']);

$router -> get('/crear', [LoginController::class, 'crear']);
$router -> post('/crear', [LoginController::class, 'crear']);

$router -> get('/olvide', [LoginController::class, 'olvide']);
$router -> post('/olvide', [LoginController::class, 'olvide']);

//cambiar-password
$router -> get('/reestablecer', [LoginController::class, 'reestablecer']);
$router -> post('/reestablecer', [LoginController::class, 'reestablecer']);

$router -> get('/mensaje', [LoginController::class, 'mensaje']);
$router -> post('/mensaje', [LoginController::class, 'mensaje']);

$router -> get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router -> post('/confirmar-cuenta', [LoginController::class, 'confirmar']);

$router -> get('/logout', [LoginController::class, 'logout']);
$router -> post('/logout', [LoginController::class, 'logout']);

/*************************ERROR********************************* */
$router -> get('/error', [ErrorController::class, 'error']);
$router -> post('/error', [ErrorController::class, 'error']);

/*************************zona privada********************************* */

$router -> get('/dashboard', [DashboardController::class, 'index']);
$router -> post('/dashboard', [DashboardController::class, 'index']);

$router -> get('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router -> post('/crear-proyecto', [DashboardController::class, 'crear_proyecto']);

$router -> get('/perfil', [DashboardController::class, 'perfil']);
$router -> post('/perfil', [DashboardController::class, 'perfil']);


/*************************fin zona privada********************************* */
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();