<?php

namespace App\Controllers;

use App\Models\Portfolio;
use App\Models\RedesSociales;
use App\Models\Proyectos;
use App\Models\Trabajos;
use App\Models\Skills;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Portfolio.php';
require_once __DIR__ . '/../Models/RedesSociales.php';

class PortfolioController extends BaseController
{
    // Ver portfolio de usuario
    public function indexAction()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ./login');
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
    // Ver portfolio de usuario
    public function getPortfolioUserAction(){
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        $portfolioModel = Portfolio::getInstancia();
        $data = $portfolioModel->get($id);
        $data['portfolioExists'] = true;
        if($data['proyectos'] == null && $data['trabajos'] == null && $data['skills'] == null && $data['redes_sociales'] == null){
            $data['portfolioExists'] = false;
        }
        $this->renderHTML('../app/views/view_portfolio.php', $data);
    }
    // Crear portfolio
    public function createAction()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ./login');
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
                $portfolioModel->set($data);

                // Redirigimos a la vista de usuario
                header("Location: ./user");
                exit();
            }
        }

        $this->renderHTML('../app/views/view_crearPortfolio.php', $data);
    }
    // Editar portfolio
    public function editAction()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: ./login');
            exit();
        }
        $usuarioId = $_SESSION['usuario']['id'];
        $error = "";
        $portfolioModel = Portfolio::getInstancia();
        $portfolio = [];
        if (!isset($_SESSION['usuario'])) {
            header('Location: ./login');
            exit();
        }
        $trabajosModel = Trabajos::getInstancia()->getTrabajos($_SESSION['usuario']['id']);
        $proyectosModel = Proyectos::getInstancia()->getProyectos($_SESSION['usuario']['id']);
        $skillsModel = Skills::getInstancia()->getSkills($_SESSION['usuario']['id']);
        $redesSocialesModel = RedesSociales::getInstancia()->getRedesSociales($_SESSION['usuario']['id']);
        if(isset($_POST["guardar"])){
            foreach ($trabajosModel as $trabajo) {
                $trabajoId = $trabajo['id'];
                $titulo = $_POST["tituloTrabajos_$trabajoId"];
                $descripcion = $_POST["descripcionTrabajos_$trabajoId"];
                $fecha_inicio = $_POST["fecha_inicioTrabajos_$trabajoId"];
                $fecha_fin = $_POST["fecha_finTrabajos_$trabajoId"];
                $logros = $_POST["logrosTrabajos_$trabajoId"];
                if(empty($titulo) || empty($descripcion) || empty($fecha_inicio) || empty($fecha_fin) || empty($logros)){
                    $error = "Todos los campos son obligatorios";
                }
            }
            foreach ($proyectosModel as $proyecto) {
                $proyectoId = $proyecto['id'];
                $titulo = $_POST["tituloProyectos_$proyectoId"];
                $descripcion = $_POST["descripcionProyectos_$proyectoId"];
                $tecnologias = $_POST["tecnologiasProyectos_$proyectoId"];
                if(empty($titulo) || empty($descripcion) || empty($tecnologias)){
                    $error = "Todos los campos son obligatorios";
                }
            }
            foreach ($skillsModel as $skill) {
                $skillId = $skill['id'];
                $habilidades = $_POST["habilidades_$skillId"];
                $categoria = $_POST["categoria_$skillId"];
                if(empty($habilidades) || empty($categoria)){
                    $error = "Todos los campos son obligatorios";
                }
            }
            foreach ($redesSocialesModel as $redSocial) {
                $redSocialId = $redSocial['id'];
                $redSocialUrl = $_POST["redes_$redSocialId"];
                if(empty($redSocialUrl)){
                    $error = "Todos los campos son obligatorios";
                }
            }
            if($error == ""){
                $portfolio["trabajos"] = [];
                $portfolio["proyectos"] = [];
                $portfolio["skills"] = [];
                $portfolio["redes_sociales"] = [];
                foreach ($trabajosModel as $trabajo) {
                    $trabajoId = $trabajo['id'];
                    $titulo = $_POST["tituloTrabajos_$trabajoId"];
                    $descripcion = $_POST["descripcionTrabajos_$trabajoId"];
                    $fecha_inicio = $_POST["fecha_inicioTrabajos_$trabajoId"];
                    $fecha_final = $_POST["fecha_finTrabajos_$trabajoId"];
                    $logros = $_POST["logrosTrabajos_$trabajoId"];
                    $trabajo = [
                        'id' => $trabajoId,
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'fecha_inicio' => $fecha_inicio,
                        'fecha_final' => $fecha_final,
                        'logros' => $logros
                    ];
                    $portfolio['trabajos'][] = $trabajo;
                }
                foreach ($proyectosModel as $proyecto) {
                    $proyectoId = $proyecto['id'];
                    $titulo = $_POST["tituloProyectos_$proyectoId"];
                    $descripcion = $_POST["descripcionProyectos_$proyectoId"];
                    $tecnologias = $_POST["tecnologiasProyectos_$proyectoId"];
                    $proyecto = [
                        'id' => $proyectoId,
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'tecnologias' => $tecnologias
                    ];
                    $portfolio['proyectos'][] = $proyecto;
                }
                foreach ($skillsModel as $skill) {
                    $skillId = $skill['id'];
                    $habilidades = $_POST["habilidades_$skillId"];
                    $categoria = $_POST["categoria_$skillId"];
                    $skill = [
                        'id' => $skillId,
                        'habilidades' => $habilidades,
                        'categorias_skills_categoria' => $categoria
                    ];
                    $portfolio['skills'][] = $skill;
                }
                foreach ($redesSocialesModel as $redSocial) {
                    $redSocialId = $redSocial['id'];
                    $redSocialUrl = $_POST["redes_$redSocialId"];
                    $redSocial = [
                        'id' => $redSocialId,
                        'url' => $redSocialUrl
                    ];
                    $portfolio['redes_sociales'][] = $redSocial;
                }
                
                $portfolioModel->edit($portfolio);
                $_SESSION['mensaje'] = "Portfolio actualizado con éxito.";
                header("Location: ../user");
            }
        }
        $data = [
            'trabajos' => $trabajosModel,
            'proyectos' => $proyectosModel,
            'skills' => $skillsModel,
            'redesSociales' => $redesSocialesModel,
            'portfolioExists' => true,
            'error' => $error
        ];

        $this->renderHTML('../app/views/view_editarPortfolio.php', $data);
    }
    // Borrar portfolio
    public function borrarAction()
    {
        $portfolioModel = Portfolio::getInstancia();
        
        if (!isset($_SESSION['usuario'])) {
            header('Location: ../');
            exit();
        }

        $usuarioId = $_SESSION['usuario']['id'];
        $portfolioModel->delete($usuarioId);

        $_SESSION["portfolio"] = false;
        header("Location: ./user");
        exit();
    }
    
    // Skills
    

}