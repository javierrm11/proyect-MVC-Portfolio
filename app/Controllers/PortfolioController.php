<?php

namespace App\Controllers;

use App\Models\Portfolio;
use App\Models\RedesSociales;
use App\Models\Proyectos;
use App\Models\Trabajos;
use App\Models\Skills;
use App\Models\CategoriasSkills;
use App\Models\Usuario;

require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Portfolio.php';
require_once __DIR__ . '/../Models/RedesSociales.php';

class PortfolioController extends BaseController
{
    // Ver portfolio de usuario
    public function indexAction()
    {
        // obtenemos el id del usuario
        $usuarioId = $_SESSION['usuario']['id'];
        $portfolioModel = Portfolio::getInstancia();
        // obtenemos los datos del portfolio
        $portfolio = $portfolioModel->get($usuarioId);
        // comprobamos si el portfolio existe
        $portfolioExist = true;
        if($portfolio['proyectos'] == null && $portfolio['trabajos'] == null && $portfolio['skills'] == null && $portfolio['redes_sociales'] == null){
            $portfolioExist = false;
        }
        // datos a pasar a la vista
        $data = [
            'portfolioExists' => $portfolioExist,
            'trabajos' => $portfolio['trabajos'],
            'proyectos' => $portfolio['proyectos'],
            'skills' => $portfolio['skills'],
            'redesSociales' => $portfolio['redes_sociales']
        ];
        $this->renderHTML('../app/views/view_user.php', $data);
    }

    // Ver portfolio de usuario
    public function getPortfolioUserAction(){
        // obtenemos el id del usuario del portfolio
        $uri = $_SERVER['REQUEST_URI'];
        $id = explode('/', $uri)[2];
        // obtenemos los datos del portfolio
        $portfolioModel = Portfolio::getInstancia();
        $data = $portfolioModel->get($id);
        $data["usuario"] = Usuario::getInstancia()->getUser($id);
        // comprobamos si el portfolio existe
        $data['portfolioExists'] = true;
        if($data['proyectos'] == null && $data['trabajos'] == null && $data['skills'] == null && $data['redes_sociales'] == null){
            $data['portfolioExists'] = false;
        }
        $this->renderHTML('../app/views/view_portfolio.php', $data);
    }

    // Crear portfolio
    public function createAction()
    {
        $usuarioId = $_SESSION['usuario']['id'];
        // Datos del formulario
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
            'error' => false,
            'portfolioExists' => Usuario::getInstancia()->getPortfolio()
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
                $portfolioModel->setTrabajo([
                    'titulo' => $data['tituloTrabajos'],
                    'descripcion' => $data['descripcionTrabajos'],
                    'fecha_inicio' => $data['fecha_inicioTrabajos'],
                    'fecha_final' => $data['fecha_finTrabajos'],
                    'logros' => $data['logrosTrabajos'],
                    'usuarioId' => $usuarioId
                ]);
                $portfolioModel->setProyecto([
                    'titulo' => $data['tituloProyectos'],
                    'descripcion' => $data['descripcionProyectos'],
                    'tecnologias' => $data['tecnologiasProyectos'],
                    'usuarioId' => $usuarioId
                ]);
                $portfolioModel->setSkill([
                    'habilidades' => $data['habilidades'],
                    'categorias_skills_categoria' => $data['categoria'],
                    'usuarioId' => $usuarioId
                ]);
                $portfolioModel->setRedesSociales([
                    'facebook' => $data['facebook'],
                    'twitter' => $data['twitter'],
                    'linkedin' => $data['linkedin'],
                    'github' => $data['github'],
                    'instagram' => $data['instagram'],
                    'usuarioId' => $usuarioId,
                ]);
                $portfolioModel->set();

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
        // Obtenemos el usuario
        $usuarioId = $_SESSION['usuario']['id'];
        $error = "";
        
        $portfolioModel = Portfolio::getInstancia();

        // Obtenemos los datos del portfolio
        $trabajosModel = Trabajos::getInstancia()->getTrabajos($usuarioId);
        $proyectosModel = Proyectos::getInstancia()->getProyectos($usuarioId);
        $skillsModel = Skills::getInstancia()->getSkills($usuarioId);
        $redesSocialesModel = RedesSociales::getInstancia()->getRedesSociales($usuarioId);

        if (isset($_POST["guardar"])) {
            $models = ['trabajos' => $trabajosModel,'proyectos' => $proyectosModel,'skills' => $skillsModel,'redes_sociales' => $redesSocialesModel];
            // Validación de errores en los campos de los formularios de trabajos, proyectos, skills y redes sociales
            foreach ($models as $type => $model) {
                foreach ($model as $item) {
                    $itemId = $item['id']; // Id del item
                    // Validación de campos vacíos según el tipo de formulario
                    switch ($type) {
                        case 'trabajos':
                            if (empty($_POST["tituloTrabajos_$itemId"]) || empty($_POST["descripcionTrabajos_$itemId"]) || empty($_POST["fecha_inicioTrabajos_$itemId"]) || empty($_POST["fecha_finTrabajos_$itemId"]) || empty($_POST["logrosTrabajos_$itemId"])) {
                                $error = "Todos los campos son obligatorios";
                            }
                            break;
                        case 'proyectos':
                            if (empty($_POST["tituloProyectos_$itemId"]) || empty($_POST["descripcionProyectos_$itemId"]) || empty($_POST["tecnologiasProyectos_$itemId"])) {
                                $error = "Todos los campos son obligatorios";
                            }
                            break;
                        case 'skills':
                            if (empty($_POST["habilidades_$itemId"]) || empty($_POST["categoria_$itemId"])) {
                                $error = "Todos los campos son obligatorios";
                            }
                            break;
                        case 'redes_sociales':
                            if (empty($_POST["redes_$itemId"])) {
                                $error = "Todos los campos son obligatorios";
                            }
                            break;
                    }
                }
            }

            // Si no hay errores, guardamos los datos
            if ($error == "") {
                $portfolio = [
                    "trabajos" => [],
                    "proyectos" => [],
                    "skills" => [],
                    "redes_sociales" => []
                ];
                // Recorremos los datos de los formularios y los guardamos en el array $portfolio
                foreach ($trabajosModel as $trabajo) {
                    $trabajoId = $trabajo['id'];
                    $portfolio['trabajos'][] = [
                        'id' => $trabajoId,
                        'titulo' => $_POST["tituloTrabajos_$trabajoId"],
                        'descripcion' => $_POST["descripcionTrabajos_$trabajoId"],
                        'fecha_inicio' => $_POST["fecha_inicioTrabajos_$trabajoId"],
                        'fecha_final' => $_POST["fecha_finTrabajos_$trabajoId"],
                        'logros' => $_POST["logrosTrabajos_$trabajoId"]
                    ];
                }
                foreach ($proyectosModel as $proyecto) {
                    $proyectoId = $proyecto['id'];
                    $portfolio['proyectos'][] = [
                        'id' => $proyectoId,
                        'titulo' => $_POST["tituloProyectos_$proyectoId"],
                        'descripcion' => $_POST["descripcionProyectos_$proyectoId"],
                        'tecnologias' => $_POST["tecnologiasProyectos_$proyectoId"]
                    ];
                }
                foreach ($skillsModel as $skill) {
                    $skillId = $skill['id'];
                    $portfolio['skills'][] = [
                        'id' => $skillId,
                        'habilidades' => $_POST["habilidades_$skillId"],
                        'categorias_skills_categoria' => $_POST["categoria_$skillId"]
                    ];
                }
                foreach ($redesSocialesModel as $redSocial) {
                    $redSocialId = $redSocial['id'];
                    $portfolio['redes_sociales'][] = [
                        'id' => $redSocialId,
                        "redes_socialescol" => $redSocial['redes_socialescol'],
                        'url' => $_POST["redes_$redSocialId"]
                    ];
                }
                $portfolioModel->setPortfolio($portfolio);
                $portfolioModel->edit();
                header("Location: ./user");
                $_SESSION['mensaje'] = "Portfolio actualizado con éxito.";
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
        
        // obtenemos el id del usuario del portfolio y borramos el portfolio
        $usuarioId = $_SESSION['usuario']['id'];
        $portfolioModel->delete($usuarioId);

        $_SESSION["portfolio"] = false;
        header("Location: ./user");
        exit();
    }

}