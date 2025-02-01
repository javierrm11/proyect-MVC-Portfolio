<?php

namespace App\Controllers;

use App\Models\Trabajos;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Trabajos.php';

class TrabajosControllers extends BaseController
{
    public function addTrabajoAction()
    {
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        if ($_SESSION["usuario"]["id"] != $id ) {
            header("Location: /");
            exit();
        }


        //obtener los datos del formulario
        $titulo = $descripcion = $fecha_inicio = $fecha_fin = $logros = "";
        $data = ['error' => ''];

        if (isset($_POST["anadirTrabajo"])) {
            $titulo = $_POST["tituloTrabajos"];
            $descripcion = $_POST["descripcionTrabajos"];
            $fecha_inicio = $_POST["fecha_inicioTrabajos"];
            $fecha_fin = $_POST["fecha_finTrabajos"];
            $logros = $_POST["logrosTrabajos"];
            $visible = 1;
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");
            $usuarios_id = $_SESSION["usuario"]["id"];
            $data['error'] = "";
            // Validar errores
            if($titulo == "" || $descripcion == "" || $fecha_inicio == "" || $fecha_fin == "" || $logros == ""){
                $data['error'] = "Todos los campos son requeridos";
            }
            if ($data['error'] == "") {
                $trabajoObj = Trabajos::getInstancia();
                $trabajoObj->setTitulo($titulo);
                $trabajoObj->setDescripcion($descripcion);
                $trabajoObj->setFechaInicio($fecha_inicio);
                $trabajoObj->setFechaFinal($fecha_fin);
                $trabajoObj->setLogros($logros);
                $trabajoObj->setVisible($visible);
                $trabajoObj->setCreatedAt($created_at);
                $trabajoObj->setUpdatedAt($updated_at);
                $trabajoObj->setUsuariosId($usuarios_id);
                $trabajoObj->set();
            }
        }
        $this->renderHTML('../app/views/view_addTrabajo.php', $data);
    }
    public function deleteTrabajoAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        $idUser = Trabajos::getInstancia()->get($id);
        if ($_SESSION["usuario"]["id"] != $idUser) {
            header("Location: /");
            exit();
        }
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        $trabajoObj = Trabajos::getInstancia();
        $trabajoObj->delete($id);
        header("Location: /user");
    }
    
    public function mostrarTrabajoAction()
    {
        $trabajoModel = Trabajos::getInstancia();
        // obtenemos la uri
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $idUser = $trabajoModel->get($id);
        // comprobamos si el usuario es el propietario del trabajo
        if (!isset($_SESSION['usuario']) || $idUser != $_SESSION['usuario']['id']) {
            var_dump($idUser);
            var_dump($_SESSION['usuario']['id']);
            exit();
        }

        $trabajoModel->mostrarTrabajo($id); // mostramos el trabajo
        // redirigimos a la vista de editar
        $_SESSION['mensaje'] = "Trabajo mostrado con éxito.";
        header('Location: ../editar');
    }

    public function ocultarTrabajoAction()
    {
        $trabajoModel = Trabajos::getInstancia();
        // obtenemos la uri
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $idUser = $trabajoModel->get($id);
        // comprobamos si el usuario es el propietario del trabajo
        if (!isset($_SESSION['usuario']) || $idUser != $_SESSION['usuario']['id']) {
            header('Location: ../');
            exit();
        }
        // ocultamos el trabajo
        $trabajoModel->ocultarTrabajo($id);
        // redirigimos a la vista de editar
        $_SESSION['mensaje'] = "Trabajo ocultado con éxito.";
        header('Location: ../editar');
    }

}
