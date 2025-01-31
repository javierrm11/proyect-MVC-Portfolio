<?php

namespace App\Controllers;

use App\Models\Skills;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Skills.php';

class SkillsController extends BaseController
{
    public function addSkillAction()
    {
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        Skills::getInstancia()->getUserSkill($id);
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
                $proyectoObj->setSkill();
            }
        }
        $this->renderHTML('../app/views/view_addSkill.php', $data);
    }
    public function deleteSkillAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        $idUser = Skills::getInstancia()->getUserSkill($id);
        if ($_SESSION["usuario"]["id"] != $idUser[0]["usuarios_id"]) {
            header("Location: /");
            exit();
        }
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        $trabajoObj = Skills::getInstancia();
        $trabajoObj->deleteSkill($id);
        header("Location: /user");
    }

}
