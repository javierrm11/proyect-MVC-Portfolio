<?php
/**
 * Aplicacion de portafolio de usuario con PHP y MySQL (POO)
 * La aplicacion permite a los usuarios registrados crear su portafolio personal con sus trabajos, proyectos, habilidades y redes sociales.
 * Tambien permite a los usuarios buscar otros usuarios y ver sus portafolios.
 * Puede ocultar su portafolio para que no sea visible a otros usuarios.
 * Puede ocultar sus trabajos, proyectos, habilidades y redes sociales para que no sean visibles a otros usuarios.
 * Puede borrar su cuenta de usuario.
 * @author javier ruiz molero
*/


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
    'action' => [UsuariosController::class, 'LogoutAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'activar',
    'path' => '/^\/activar$/',
    'action' => [UsuariosController::class, 'activarAction']
]);
$router->add([
    'name' => 'buscar',
    'path' => '/^\/buscar(\?q=.*)?$/',
    'action' => [UsuariosController::class, 'buscarAction']
]);
$router->add([
    'name' => 'ocultarUsuario',
    'path' => '/^\/ocultarUsuario$/',
    'action' => [UsuariosController::class, 'ocultarUsuarioAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'mostrarUsuario',
    'path' => '/^\/mostrarUsuario$/',
    'action' => [UsuariosController::class, 'mostrarUsuarioAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'borrarUsuario',
    'path' => '/^\/borrarUsuario$/',
    'action' => [UsuariosController::class, 'borrarUsuarioAction'],
    'perfil' => ['usuario']
]);
// rutas de portfolio
$router->add([
    'name' => 'user',
    'path' => '/^\/user$/',
    'action' => [PortfolioController::class, 'indexAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'portfolio',
    'path' => '/^\/portfolio\/(\d+)$/',
    'action' => [PortfolioController::class, 'getPortfolioUserAction']
]);
$router->add([
    'name' => 'crearPortfolio',
    'path' => '/^\/crearPortfolio$/',
    'action' => [PortfolioController::class, 'createAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'borrarPortfolio',
    'path' => '/^\/borrar$/',
    'action' => [PortfolioController::class, 'borrarAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'editarPortfolio',
    'path' => '/^\/editar$/',
    'action' => [PortfolioController::class, 'editAction'],
    'perfil' => ['usuario']
]);
// rutas de trabajos
$router->add([
    'name' => 'addTrabajo',
    'path' => '/^\/addTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'addTrabajoAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'eliminarTrabajo',
    'path' => '/^\/eliminarTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'deleteTrabajoAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'mostrarTrabajo',
    'path' => '/^\/mostrarTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'mostrarTrabajoAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'ocultarTrabajo',
    'path' => '/^\/ocultarTrabajo\/(\d+)$/',
    'action' => [TrabajosControllers::class, 'ocultarTrabajoAction'],
    'perfil' => ['usuario']
]);
// rutas de proyectos
$router->add([
    'name' => 'addProyecto',
    'path' => '/^\/addProyecto\/(\d+)$/',
    'action' => [ProyectosControllers::class, 'addProyectoAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'eliminarProyecto',
    'path' => '/^\/eliminarProyecto\/(\d+)$/',
    'action' => [ProyectosControllers::class, 'deleteProyectoAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'mostrarProyecto',
    'path' => '/^\/mostrarProyecto\/(\d+)$/',
    'action' => [ProyectosControllers::class, 'mostrarProyectoAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'ocultarProyecto',
    'path' => '/^\/ocultarProyecto\/(\d+)$/',
    'action' => [ProyectosControllers::class, 'ocultarProyectoAction'],
    'perfil' => ['usuario']
]);
// rutas de skills
$router->add([
    'name' => 'addSkill',
    'path' => '/^\/addSkill\/(\d+)$/',
    'action' => [SkillsController::class, 'addSkillAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'eliminarSkill',
    'path' => '/^\/eliminarSkill\/(\d+)$/',
    'action' => [SkillsController::class, 'deleteSkillAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'mostrarSkill',
    'path' => '/^\/mostrarSkill\/(\d+)$/',
    'action' => [SkillsController::class, 'mostrarSkillAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'ocultarSkill',
    'path' => '/^\/ocultarSkill\/(\d+)$/',
    'action' => [SkillsController::class, 'ocultarSkillAction'],
    'perfil' => ['usuario']
]);

// rutas de redes sociales
$router->add([
    'name' => 'addRedSocial',
    'path' => '/^\/addRedSocial\/(\d+)$/',
    'action' => [RedesSocialesController::class, 'addRedSocialAction'],
    'perfil' => ['usuario']
]);
$router->add([
    'name' => 'eliminarRedSocial',
    'path' => '/^\/eliminarRedSocial\/(\d+)$/',
    'action' => [RedesSocialesController::class, 'eliminarRedSocialAction'],
    'perfil' => ['usuario']
]);


// Obtenemos la ruta de la petición
$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request); // Comprobamos que coincide una ruta

// Si coincide una ruta, creamos una instancia del controlador y llamamos al método
if ($route) {
    if(isset($route['perfil'])) {
        if(!isset($_SESSION['usuario']) || $route['perfil'] == 'usuario') {
            $_SESSION['error'] = 'No tienes permisos para acceder a esta página.';
            header('Location: /');
            exit;
        }
    }
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