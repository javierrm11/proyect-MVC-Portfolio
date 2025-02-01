<?php
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../vendor/autoload.php";
require_once "../bootstrap.php";
require_once "../app/Controllers/UsuariosController.php";
require_once "../app/Core/Router.php";
require_once "../app/Controllers/PortfolioController.php";
require_once "../app/Controllers/TrabajosController.php";
require_once "../app/Controllers/ProyectosController.php";
require_once "../app/Controllers/SkillsController.php";
require_once "../app/Controllers/RedesSocialesController.php";

// Usamos el espacio de nombres de las clases
use App\Controllers\PortfolioController;
use App\Controllers\ProyectosControllers;
use App\Controllers\RedesSocialesController;
use App\Controllers\SkillsController;
use App\Controllers\TrabajosControllers;
use App\Controllers\UsuariosController;
// Usamos la clase Router
use App\Core\Router;

// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array

// ruta de la página principal
$router->add([
    'name' => 'primera',
    'path' => '/^\/$/',
    'action' => [UsuariosController::class, 'IndexAction']
]);

// rutas de usuarios
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
    'name' => 'logout',
    'path' => '/^\/logout$/',
    'action' => [UsuariosController::class, 'LogoutAction']
]);
$router->add([
    'name' => 'activar',
    'path' => '/^\/activar$/',
    'action' => [UsuariosController::class, 'activarAction']
]);
$router->add([
    'name' => 'buscar',
    'path' => '/^\/buscar$/',
    'action' => [UsuariosController::class, 'buscarAction']
]);
$router->add([
    'name' => 'ocultarUsuario',
    'path' => '/^\/ocultarUsuario$/',
    'action' => [UsuariosController::class, 'ocultarUsuarioAction']
]);
$router->add([
    'name' => 'mostrarUsuario',
    'path' => '/^\/mostrarUsuario$/',
    'action' => [UsuariosController::class, 'mostrarUsuarioAction']
]);
$router->add([
    'name' => 'borrarUsuario',
    'path' => '/^\/borrarUsuario$/',
    'action' => [UsuariosController::class, 'borrarUsuarioAction']
]);
// rutas de portfolio
$router->add([
    'name' => 'user',
    'path' => '/^\/user$/',
    'action' => [PortfolioController::class, 'indexAction']
]);
$router->add([
    'name' => 'portfolio',
    'path' => '/^\/portfolio\/(\d+)$/',
    'action' => [PortfolioController::class, 'getPortfolioUserAction']
]);
$router->add([
    'name' => 'crearPortfolio',
    'path' => '/^\/crearPortfolio$/',
    'action' => [PortfolioController::class, 'createAction']
]);
$router->add([
    'name' => 'borrarPortfolio',
    'path' => '/^\/borrar$/',
    'action' => [PortfolioController::class, 'borrarAction']
]);
$router->add([
    'name' => 'editarPortfolio',
    'path' => '/^\/editar$/',
    'action' => [PortfolioController::class, 'editAction']
]);
// rutas de trabajos
$router->add([
    'name' => 'addTrabajo',
    'path' => '/^\/addTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'addTrabajoAction']
]);
$router->add([
    'name' => 'eliminarTrabajo',
    'path' => '/^\/eliminarTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'deleteTrabajoAction']
]);
$router->add([
    'name' => 'mostrarTrabajo',
    'path' => '/^\/mostrarTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'mostrarTrabajoAction']
]);
$router->add([
    'name' => 'ocultarTrabajo',
    'path' => '/^\/ocultarTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'ocultarTrabajoAction']
]);
// rutas de proyectos
$router->add([
    'name' => 'addProyecto',
    'path' => '/^\/addProyecto\/(\d+)$/',
    'action' => [ProyectosControllers::class, 'addProyectoAction']
]);
$router->add([
    'name' => 'eliminarProyecto',
    'path' => '/^\/eliminarProyecto\/(\d+)$/',
    'action' => [ProyectosControllers::class, 'deleteProyectoAction']
]);
$router->add([
    'name' => 'mostrarProyecto',
    'path' => '/^\/mostrarProyecto\/(\d+)$/',
    'action' => [PortfolioController::class, 'mostrarProyectoAction']
]);
$router->add([
    'name' => 'ocultarProyecto',
    'path' => '/^\/ocultarProyecto\/(\d+)$/',
    'action' => [PortfolioController::class, 'ocultarProyectoAction']
]);
// rutas de skills
$router->add([
    'name' => 'addSkill',
    'path' => '/^\/addSkill\/(\d+)$/',
    'action' => [SkillsController::class, 'addSkillAction']
]);
$router->add([
    'name' => 'eliminarSkill',
    'path' => '/^\/eliminarSkill\/(\d+)$/',
    'action' => [SkillsController::class, 'deleteSkillAction']
]);
$router->add([
    'name' => 'mostrarSkill',
    'path' => '/^\/mostrarSkill\/(\d+)$/',
    'action' => [PortfolioController::class, 'mostrarSkillAction']
]);
$router->add([
    'name' => 'ocultarSkill',
    'path' => '/^\/ocultarSkill\/(\d+)$/',
    'action' => [PortfolioController::class, 'ocultarSkillAction']
]);

// rutas de redes sociales
$router->add([
    'name' => 'addRedSocial',
    'path' => '/^\/addRedSocial\/(\d+)$/',
    'action' => [RedesSocialesController::class, 'addRedSocialAction']
]);
$router->add([
    'name' => 'eliminarRedSocial',
    'path' => '/^\/eliminarRedSocial\/(\d+)$/',
    'action' => [RedesSocialesController::class, 'eliminarRedSocialAction']
]);


// Obtenemos la ruta de la petición
$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request); // Comprobamos que coincide una ruta

// Si coincide una ruta, creamos una instancia del controlador y llamamos al método
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