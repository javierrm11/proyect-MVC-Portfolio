<?php

namespace App\Controllers;

use App\Models\Proyectos;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Proyectos.php';

class ProyectosControllers extends BaseController
{
    public function addProyectoAction()
    {
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario es el propietario del proyecto
        if ($_SESSION["usuario"]["id"] != $id) {
            header("Location: /");
            exit();
        }


        //obtener los datos del formulario
        $titulo = $descripcion = $tecnologias = "";
        $data = ['error' => ''];

        if (isset($_POST["anadirProyecto"])) {
            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];
            $tecnologias = $_POST["tecnologias"];
            $visible = 1;
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");
            $usuarios_id = $_SESSION["usuario"]["id"];
            $data['error'] = "";
            // Validar errores
            if($titulo == "" || $descripcion == "" || $tecnologias == ""){
                $data['error'] = "Todos los campos son requeridos";
            }
            if ($data['error'] == "") {
                $proyectoObj = Proyectos::getInstancia();
                $proyectoObj->setTitulo($titulo);
                $proyectoObj->setDescripcion($descripcion);
                $proyectoObj->setTecnologias($tecnologias);
                $proyectoObj->setVisible($visible);
                $proyectoObj->setCreatedAt($created_at);
                $proyectoObj->setUpdatedAt($updated_at);
                $proyectoObj->setUsuariosId($usuarios_id);
                $proyectoObj->set();
                header('Location: /editar');
            }
        }
        $this->renderHTML('../app/views/view_addProyecto.php', $data);
    }
    // funcion para editar proyecto
    public function deleteProyectoAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario es el propietario del proyecto
        $idUser = Proyectos::getInstancia()->get($id);
        if ($_SESSION["usuario"]["id"] != $idUser) {
            header("Location: /");
            exit();
        }
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        $trabajoObj = Proyectos::getInstancia();
        $trabajoObj->delete($id);
        header("Location: /user");
    }
    // funcion para mostrar proyecto
    public function mostrarProyectoAction()
    {
        $proyectosModel = Proyectos::getInstancia();
        // obtenemos la uri
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $idUser = $proyectosModel->get($id);
        // comprobamos si el usuario es el propietario del proyecto
        if ($idUser != $_SESSION['usuario']['id']) {
            header('Location: ../');
            exit();
        }

        $proyectosModel->mostrarProyecto($id); // mostramos el proyecto
        // redirigimos a la vista de editar
        $_SESSION['mensaje'] = "proyecto mostrado con éxito.";
        header('Location: ../editar');
    }
    // funcion para ocultar proyecto
    public function ocultarProyectoAction()
    {
        $proyectosModel = Proyectos::getInstancia();
        // obtenemos la uri
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $idUser = $proyectosModel->get($id);
        // comprobamos si el usuario es el propietario del proyecto
        if ($idUser != $_SESSION['usuario']['id']) {
            header('Location: ../');
            exit();
        }

        $proyectosModel->ocultarProyecto($id);  // ocultamos el proyecto
        // redirigimos a la vista de editar
        $_SESSION['mensaje'] = "proyecto ocultado con éxito.";
        header('Location: ../editar');
    }

}
