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
        //validar si el usuario esta logeado
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
                $proyectoObj->setProyecto();
            }
        }
        $this->renderHTML('../app/views/view_addProyecto.php', $data);
    }
    public function deleteProyectoAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        $idUser = Proyectos::getInstancia()->getUserProyecto($id);
        if ($_SESSION["usuario"]["id"] != $idUser[0]["usuarios_id"]) {
            header("Location: /");
            exit();
        }
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        $trabajoObj = Proyectos::getInstancia();
        $trabajoObj->deleteProyecto($id);
        header("Location: /user");
    }

}
