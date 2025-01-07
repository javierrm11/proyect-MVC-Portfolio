<?php
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../vendor/autoload.php";
require_once "../bootstrap.php";
require_once "../app/Controllers/UsuariosController.php";
require_once "../app/Core/Router.php";
require_once "../app/Controllers/PortfolioController.php";

// Usamos el espacio de nombre

use App\Controllers\PortfolioController;
use App\Core\Router;
use App\Controllers\UsuariosController;


// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array
$router->add([
    'name' => 'primera',
    'path' => '/^\/$/',
    'action' => [UsuariosController::class, 'IndexAction']
]);
$router->add([
    'name' => 'registro',
    'path' => '/^\/registro$/',
    'action' => [UsuariosController::class, 'AddAction']
]);
$router->add([
    'name' => 'login',
    'path' => '/^\/login$/',
    'action' => [UsuariosController::class, 'LoginAction']
]);
$router->add([
    'name' => 'user',
    'path' => '/^\/user$/',
    'action' => [PortfolioController::class, 'index']
]);
$router->add([
    'name' => 'crearPortfolio',
    'path' => '/^\/crearPortfolio$/',
    'action' => [PortfolioController::class, 'create']
]);
$router->add([
    'name' => 'borrarPortfolio',
    'path' => '/^\/borrar$/',
    'action' => [PortfolioController::class, 'borrar']
]);
$router->add([
    'name' => 'editarPortfolio',
    'path' => '/^\/editar$/',
    'action' => [PortfolioController::class, 'edit']
]);
$router->add([
    'name' => 'mostrarTrabajo',
    'path' => '/^\/mostrarTrabajo\/(\d+)$/',
    'action' => [PortfolioController::class, 'mostrarTrabajo']
]);
$router->add([
    'name' => 'ocultarTrabajo',
    'path' => '/^\/ocultarTrabajo\/(\d+)$/',
    'action' => [PortfolioController::class, 'ocultarTrabajo']
]);
$router->add([
    'name' => 'mostrarProyecto',
    'path' => '/^\/mostrarProyecto\/(\d+)$/',
    'action' => [PortfolioController::class, 'mostrarProyecto']
]);
$router->add([
    'name' => 'ocultarProyecto',
    'path' => '/^\/ocultarProyecto\/(\d+)$/',
    'action' => [PortfolioController::class, 'ocultarProyecto']
]);
$router->add([
    'name' => 'mostrarSkill',
    'path' => '/^\/mostrarSkill\/(\d+)$/',
    'action' => [PortfolioController::class, 'mostrarSkill']
]);
$router->add([
    'name' => 'ocultarSkill',
    'path' => '/^\/ocultarSkill\/(\d+)$/',
    'action' => [PortfolioController::class, 'ocultarSkill']
]);
$router->add([
    'name' => 'logout',
    'path' => '/^\/logout$/',
    'action' => [UsuariosController::class, 'LogoutAction']
]);
$router->add([
    'name' => 'activar',
    'path' => '/^\/activar$/',
    'action' => [UsuariosController::class, 'activar']
]);
$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request); // Comprobamos que coincide una ruta

if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    if (isset($route['params'])) {
        $controller->$actionName(...$route['params']);
    } else {
        $controller->$actionName();
    }
} else {
    // Manejo de parámetros GET
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controllerName = 'App\\Controllers\\' . $_GET['controller'] . 'Controller';
        $actionName = $_GET['action'];
        if (class_exists($controllerName) && method_exists($controllerName, $actionName)) {
            $controller = new $controllerName;
            $controller->$actionName();
        } else {
            echo "No route found.";
        }
    } else {
        echo "No route found.";
    }
}