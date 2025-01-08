<?php

namespace App\Controllers;

use App\Models\Portfolio;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Portfolio.php';

class PortfolioController extends BaseController
{
    public function index()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }

        $usuarioId = $_SESSION['usuario']['id'];
        $portfolioModel = Portfolio::getInstancia();

        $portfolio = $portfolioModel->getPortfolio($usuarioId);

        $data = [
            'portfolioExists' => !empty($portfolio['redes_sociales']),
            'trabajos' => $portfolio['trabajos'],
            'proyectos' => $portfolio['proyectos'],
            'skills' => $portfolio['skills'],
            'redesSociales' => $portfolio['redes_sociales']
        ];

        $this->renderHTML('../app/views/view_user.php', $data);
    }

    public function create()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }

        $usuarioId = $_SESSION['usuario']['id'];
        $data = [
            'tituloTrabajos' => '',
            'descripcionTrabajos' => '',
            'fecha_inicioTrabajos' => '',
            'fecha_finTrabajos' => '',
            'logrosTrabajos' => '',
            'tituloProyectos' => '',
            'descripcionProyectos' => '',
            'tecnologiasProyectos' => '',
            'habilidades' => '',
            'categoria' => '',
            'facebook' => '',
            'twitter' => '',
            'linkedin' => '',
            'github' => '',
            'instagram' => '',
            'eTituloTrabajos' => '',
            'eDescripcionTrabajos' => '',
            'eFecha_inicioTrabajos' => '',
            'eFecha_finTrabajos' => '',
            'eLogrosTrabajos' => '',
            'eTituloProyectos' => '',
            'eDescripcionProyectos' => '',
            'eTecnologiasProyectos' => '',
            'eHabilidades' => '',
            'eCategoria' => '',
            'eFacebook' => '',
            'eTwitter' => '',
            'eLinkedin' => '',
            'eGithub' => '',
            'eInstagram' => '',
            'error' => false
        ];

        if (isset($_POST["guardar"])) {
            // Recogemos los datos del formulario
            $data['tituloTrabajos'] = $_POST["tituloTrabajos"];
            $data['descripcionTrabajos'] = $_POST["descripcionTrabajos"];
            $data['fecha_inicioTrabajos'] = $_POST["fecha_inicioTrabajos"];
            $data['fecha_finTrabajos'] = $_POST["fecha_finTrabajos"];
            $data['logrosTrabajos'] = $_POST["logrosTrabajos"];
            $data['tituloProyectos'] = $_POST["tituloProyectos"];
            $data['descripcionProyectos'] = $_POST["descripcionProyectos"];
            $data['tecnologiasProyectos'] = $_POST["tecnologiasProyectos"];
            $data['habilidades'] = $_POST["habilidades"];
            $data['categoria'] = $_POST["categoria"];
            $data['facebook'] = $_POST["facebook"];
            $data['twitter'] = $_POST["twitter"];
            $data['linkedin'] = $_POST["linkedin"];
            $data['github'] = $_POST["github"];
            $data['instagram'] = $_POST["instagram"];

            // Validación de errores
            if ($data['tituloTrabajos'] == "") {
                $data['eTituloTrabajos'] = "El titulo es obligatorio";
                $data['error'] = true;
            }
            if ($data['descripcionTrabajos'] == "") {
                $data['eDescripcionTrabajos'] = "La descripción es obligatoria";
                $data['error'] = true;
            }
            if ($data['fecha_inicioTrabajos'] == "") {
                $data['eFecha_inicioTrabajos'] = "La fecha de inicio es obligatoria";
                $data['error'] = true;
            }
            if ($data['fecha_finTrabajos'] == "") {
                $data['eFecha_finTrabajos'] = "La fecha de fin es obligatoria";
                $data['error'] = true;
            }
            if ($data['logrosTrabajos'] == "") {
                $data['eLogrosTrabajos'] = "Los logros son obligatorios";
                $data['error'] = true;
            }
            if ($data['tituloProyectos'] == "") {
                $data['eTituloProyectos'] = "El titulo es obligatorio";
                $data['error'] = true;
            }
            if ($data['descripcionProyectos'] == "") {
                $data['eDescripcionProyectos'] = "La descripción es obligatoria";
                $data['error'] = true;
            }
            if ($data['tecnologiasProyectos'] == "") {
                $data['eTecnologiasProyectos'] = "Las tecnologias son obligatorias";
                $data['error'] = true;
            }
            if ($data['habilidades'] == "") {
                $data['eHabilidades'] = "Las habilidades son obligatorias";
                $data['error'] = true;
            }
            if ($data['categoria'] == "") {
                $data['eCategoria'] = "La categoria es obligatoria";
                $data['error'] = true;
            }
            if ($data['facebook'] == "") {
                $data['eFacebook'] = "El facebook es obligatorio";
                $data['error'] = true;
            }
            if ($data['twitter'] == "") {
                $data['eTwitter'] = "El twitter es obligatorio";
                $data['error'] = true;
            }
            if ($data['linkedin'] == "") {
                $data['eLinkedin'] = "El linkedin es obligatorio";
                $data['error'] = true;
            }
            if ($data['github'] == "") {
                $data['eGithub'] = "El github es obligatorio";
                $data['error'] = true;
            }
            if ($data['instagram'] == "") {
                $data['eInstagram'] = "El instagram es obligatorio";
                $data['error'] = true;
            }

            if (!$data['error']) {
                // Guardamos los datos en la base de datos
                $data['usuarioId'] = $usuarioId;
                $portfolioModel = Portfolio::getInstancia();
                $portfolioModel->setPortfolio($data);

                // Redirigimos a la vista de usuario
                header("Location: ./user");
                exit();
            }
        }

        $this->renderHTML('../app/views/view_crearPortfolio.php', $data);
    }
    public function edit()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }

        $usuarioId = $_SESSION['usuario']['id'];
        $portfolioModel = Portfolio::getInstancia();
        $portfolio = $portfolioModel->getPortfolioAll($usuarioId);

        $data = [
            'portfolioExists' => !empty($portfolio['proyectos']),
            'trabajos' => $portfolio['trabajos'],
            'proyectos' => $portfolio['proyectos'],
            'skills' => $portfolio['skills'],
            'redesSociales' => $portfolio['redes_sociales'],
            'eTituloProyectos' => '',
            'eDescripcionProyectos' => '',
            'eTecnologiasProyectos' => '',
            'eTituloTrabajos' => '',
            'eDescripcionTrabajos' => '',
            'eFecha_inicioTrabajos' => '',
            'eFecha_finTrabajos' => '',
            'eLogrosTrabajos' => '',
            'eHabilidades' => '',
            'eCategoria' => '',
            'eFacebook' => '',
            'eTwitter' => '',
            'eLinkedin' => '',
            'eGithub' => '',
            'eInstagram' => '',
            'error' => false
        ];

        if (isset($_POST["guardar"])) {
            // Recogemos los datos del formulario
            $data['tituloProyectos'] = $_POST["tituloProyectos"];
            $data['descripcionProyectos'] = $_POST["descripcionProyectos"];
            $data['tecnologiasProyectos'] = $_POST["tecnologiasProyectos"];
            $data['tituloTrabajos'] = $_POST["tituloTrabajos"];
            $data['descripcionTrabajos'] = $_POST["descripcionTrabajos"];
            $data['fecha_inicioTrabajos'] = $_POST["fecha_inicioTrabajos"];
            $data['fecha_finTrabajos'] = $_POST["fecha_finTrabajos"];
            $data['logrosTrabajos'] = $_POST["logrosTrabajos"];
            $data['habilidades'] = $_POST["habilidades"];
            $data['categoria'] = $_POST["categoria"];
            $data['facebook'] = $_POST["facebook"];
            $data['twitter'] = $_POST["twitter"];
            $data['linkedin'] = $_POST["linkedin"];
            $data['github'] = $_POST["github"];
            $data['instagram'] = $_POST["instagram"];

            // Validación de errores
            if (empty($data['tituloProyectos'])) {
                $data['eTituloProyectos'] = "El campo titulo es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['descripcionProyectos'])) {
                $data['eDescripcionProyectos'] = "El campo descripcion es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['tecnologiasProyectos'])) {
                $data['eTecnologiasProyectos'] = "El campo tecnologias es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['tituloTrabajos'])) {
                $data['eTituloTrabajos'] = "El campo titulo es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['descripcionTrabajos'])) {
                $data['eDescripcionTrabajos'] = "El campo descripcion es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['fecha_inicioTrabajos'])) {
                $data['eFecha_inicioTrabajos'] = "El campo fecha de inicio es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['fecha_finTrabajos'])) {
                $data['eFecha_finTrabajos'] = "El campo fecha de fin es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['logrosTrabajos'])) {
                $data['eLogrosTrabajos'] = "El campo logros es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['habilidades'])) {
                $data['eHabilidades'] = "El campo habilidades es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['categoria'])) {
                $data['eCategoria'] = "El campo categoria es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['facebook'])) {
                $data['eFacebook'] = "El campo facebook es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['twitter'])) {
                $data['eTwitter'] = "El campo twitter es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['linkedin'])) {
                $data['eLinkedin'] = "El campo linkedin es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['github'])) {
                $data['eGithub'] = "El campo github es obligatorio";
                $data['error'] = true;
            }
            if (empty($data['instagram'])) {
                $data['eInstagram'] = "El campo instagram es obligatorio";
                $data['error'] = true;
            }

            if (!$data['error']) {
                $data['usuarioId'] = $usuarioId;
                $portfolioModel->editPortfolio($data);

                // Redirigimos a la vista de usuario
                header("Location: ./user");
                exit();
            }
        }

        $this->renderHTML('../app/views/view_editarPortfolio.php', $data);
    }

    public function borrar()
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }

        $usuarioId = $_SESSION['usuario']['id'];
        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->deletePortfolio($usuarioId);

        $_SESSION["portfolio"] = false;
        header("Location: ./user");
        exit();
    }
    // Trabajos
    public function mostrarTrabajo()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];

        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->mostrarTrabajo($id);

        $_SESSION['mensaje'] = "Trabajo mostrado con éxito.";
        header('Location: ../editar');
    }

    public function ocultarTrabajo()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->ocultarTrabajo($id);

        $_SESSION['mensaje'] = "Trabajo ocultado con éxito.";
        header('Location: ../editar');
    }
    // Proyectos
    public function mostrarProyecto()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];

        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->mostrarProyecto($id);

        $_SESSION['mensaje'] = "proyecto mostrado con éxito.";
        header('Location: ../editar');
    }

    public function ocultarProyecto()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];

        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->ocultarProyecto($id);

        $_SESSION['mensaje'] = "proyecto ocultado con éxito.";
        header('Location: ../editar');
    }
    // Skills
    public function mostrarSkill()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];

        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->mostrarSkill($id);

        $_SESSION['mensaje'] = "Skill mostrado con éxito.";
        header('Location: ../editar');
    }
    public function ocultarSkill()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: view_login.php');
            exit();
        }
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];

        $portfolioModel = Portfolio::getInstancia();
        $portfolioModel->ocultarSkill($id);
        $_SESSION['mensaje'] = "Skill ocultado con éxito.";
        header('Location: ../editar');
    }

}