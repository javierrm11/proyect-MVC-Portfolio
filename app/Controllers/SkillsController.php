<?php

namespace App\Controllers;

use App\Models\Skills;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Skills.php';

class SkillsController extends BaseController
{
    // Método para añadir un skill
    public function addSkillAction()
    {
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario es el propietario de la skill
        if ($_SESSION["usuario"]["id"] != $id) {
            header("Location: /");
            exit();
        }


        //obtener los datos del formulario
        $habilidades = $categoria = "";
        $data = ['error' => ''];

        if (isset($_POST["anadirSkill"])) {
            $habilidades = $_POST["habilidades"];
            $categoria = $_POST["categoria"];
            $visible = 1;
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");
            $usuarios_id = $_SESSION["usuario"]["id"];
            $data['error'] = "";
            // Validar errores
            if($habilidades == "" || $categoria == ""){
                $data['error'] = "Todos los campos son requeridos";
            }
            if ($data['error'] == "") {
                $proyectoObj = Skills::getInstancia();
                $proyectoObj->setHabilidades($habilidades);
                $proyectoObj->setCategoriasSkillsCategoria($categoria);
                $proyectoObj->setVisible($visible);
                $proyectoObj->setCreatedAt($created_at);
                $proyectoObj->setUpdatedAt($updated_at);
                $proyectoObj->setUsuariosId($usuarios_id);
                $proyectoObj->set();
                header('Location: /editar');
            }
        }
        $this->renderHTML('../app/views/view_addSkill.php', $data);
    }
    // Método para editar un skill
    public function deleteSkillAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario es el propietario de la skill
        $idUser = Skills::getInstancia()->get($id);
        if ($_SESSION["usuario"]["id"] != $idUser) {
            header("Location: /");
            exit();
        }
        $trabajoObj = Skills::getInstancia();
        $trabajoObj->delete($id);
        header("Location: /user");
    }
    // Método para mostrar un skill
    public function mostrarSkillAction()
    {
        $skillsModel = Skills::getInstancia();
        // obtenemos la uri
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $idUser = $skillsModel->get($id);
        // comprobamos si el usuario es el propietario de la skill
        if ($idUser != $_SESSION['usuario']['id']) {
            header('Location: ../');
            exit();
        }
        $skillsModel->mostrarSkill($id); // mostramos el skill
        // redirigimos a la vista de editar
        $_SESSION['mensaje'] = "Skill mostrado con éxito.";
        header('Location: ../editar');
    }
    // Método para ocultar un skill
    public function ocultarSkillAction()
    {
        $skillsModel = Skills::getInstancia();
        // obtenemos la uri
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $idUser = $skillsModel->get($id);
        // comprobamos si el usuario es el propietario de la skill
        if ($idUser != $_SESSION['usuario']['id']) {
            header('Location: ../');
            exit();
        }

        $skillsModel->ocultarSkill($id); // ocultamos el skill
        // redirigimos a la vista de editar
        $_SESSION['mensaje'] = "Skill ocultado con éxito.";
        header('Location: ../editar');
    }

}
