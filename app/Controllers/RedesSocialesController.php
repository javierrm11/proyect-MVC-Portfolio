<?php

namespace App\Controllers;

use App\Models\RedesSociales;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/RedesSociales.php';

class RedesSocialesController extends BaseController
{
    public function addRedSocialAction()
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

        $data = ['error' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $redSocial = $_POST['redSocial'] ?? '';
            $url = $_POST['url'] ?? '';

            if (empty($redSocial) || empty($url)) {
                $data['error'] = 'Todos los campos son obligatorios';
                $this->renderHTML('../app/views/view_addRedSocial.php', $data);
                return;
            }

            if ($data['error'] == '') {
                $redSocialModel = RedesSociales::getInstancia();
                $redSocialModel->setRedesSocialescol($redSocial);
                $redSocialModel->setUrl($url);
                $redSocialModel->setCreated_at(date('Y-m-d H:i:s'));
                $redSocialModel->setUpdated_at(date('Y-m-d H:i:s'));
                $redSocialModel->setUsuarios_id($_SESSION['usuario']['id']);
                $redSocialModel->setRedSocial();
                header('Location: /user');
                exit();
            }
        }

        $this->renderHTML('../app/views/view_addRedSocial.php', $data);
    }
    public function eliminarRedSocialAction(){
        //obtener url
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $id = $url[2];
        //validar si el usuario esta logeado
        $idUser = RedesSociales::getInstancia()->getUserRedSocial($id);
        if ($_SESSION["usuario"]["id"] != $idUser) {
            header("Location: /");
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $redSocialModel = RedesSociales::getInstancia();
        $redSocialModel->setId($id);
        $redSocialModel->deleteRedSocial();
        header('Location: /user');
    }
}