<?php

namespace App\Controllers;

use App\Models\RedesSociales;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/RedesSociales.php';

class RedesSocialesController extends BaseController
{
    // función para agregar una red social
    public function addRedSocialAction()
    {
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario es el mismo que esta logeado
        if ($_SESSION["usuario"]["id"] != $id) {
            header("Location: /");
            exit();
        }

        $data = ['error' => ''];
        // si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $redSocial = $_POST['redSocial'] ?? '';
            $url = $_POST['url'] ?? '';
            // validar que los campos no estén vacíos
            if (empty($redSocial) || empty($url)) {
                $data['error'] = 'Todos los campos son obligatorios';
                $this->renderHTML('../app/views/view_addRedSocial.php', $data);
                return;
            }
            // enviar los datos a la base de datos
            if ($data['error'] == '') {
                $redSocialModel = RedesSociales::getInstancia();
                $redSocialModel->setRedesSocialescol($redSocial);
                $redSocialModel->setUrl($url);
                $redSocialModel->setCreated_at(date('Y-m-d H:i:s'));
                $redSocialModel->setUpdated_at(date('Y-m-d H:i:s'));
                $redSocialModel->setUsuarios_id($_SESSION['usuario']['id']);
                $redSocialModel->set();
                header('Location: /editar');
                exit();
            }
        }

        $this->renderHTML('../app/views/view_addRedSocial.php', $data);
    }
    // función para eliminar una red social
    public function eliminarRedSocialAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        $idUser = RedesSociales::getInstancia()->get($id);
        if ($_SESSION["usuario"]["id"] != $idUser) {
            header("Location: /");
            exit();
        }
        $redSocialModel = RedesSociales::getInstancia();
        $redSocialModel->setId($id);
        $redSocialModel->delete();
        header('Location: /user');
    }
}