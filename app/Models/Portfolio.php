<?php

namespace App\Models;

require_once 'DBAbstractModel.php';
require_once "CategoriaSkill.php";
class Portfolio extends DBAbstractModel
{
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    private $trabajo;
    private $proyecto;
    private $skill;
    private $redes_sociales;
    public function set($data = [])
    {
        // Guardar proyectos
        $trabajoModel = Trabajos::getInstancia();
        $trabajoModel->setTitulo($data['tituloTrabajos']);
        $trabajoModel->setDescripcion($data['descripcionTrabajos']);
        $trabajoModel->setFechaInicio($data['fecha_inicioTrabajos']);
        $trabajoModel->setFechaFinal($data['fecha_finTrabajos']);
        $trabajoModel->setLogros($data['logrosTrabajos']);
        $trabajoModel->setVisible(1);
        $trabajoModel->setCreatedAt(date("Y-m-d H:i:s"));
        $trabajoModel->setUpdatedAt(date("Y-m-d H:i:s"));
        $trabajoModel->setUsuariosId($data['usuarioId']);
        $trabajoModel->set();

        // Guardar trabajos
        $proyectoModel = Proyectos::getInstancia();
        $proyectoModel->setTitulo($data['tituloProyectos']);
        $proyectoModel->setDescripcion($data['descripcionProyectos']);
        $proyectoModel->setTecnologias($data['tecnologiasProyectos']);
        $proyectoModel->setVisible(1);
        $proyectoModel->setCreatedAt(date("Y-m-d H:i:s"));
        $proyectoModel->setUpdatedAt(date("Y-m-d H:i:s"));
        $proyectoModel->setUsuariosId($data['usuarioId']);
        $proyectoModel->set();

        // Guardar skills
        $skillModel = Skills::getInstancia();
        $skillModel->setHabilidades($data['habilidades']);
        $skillModel->setVisible(1);
        $skillModel->setCreatedAt(date("Y-m-d H:i:s"));
        $skillModel->setUpdatedAt(date("Y-m-d H:i:s"));
        $skillModel->setCategoriasSkillsCategoria($data['categoria']);
        $skillModel->setUsuariosId($data['usuarioId']);
        $skillModel->set();
        
        // Guardar redes sociales
        $redesSociales = ['facebook', 'twitter', 'linkedin', 'github', 'instagram'];
        foreach ($redesSociales as $red) {
            $redesSocialesModel = RedesSociales::getInstancia();
            $redesSocialesModel->setRedesSocialescol($red);
            $redesSocialesModel->setUrl($data[$red]);
            $redesSocialesModel->setUsuarios_Id($data['usuarioId']);
            $redesSocialesModel->set();
        }
    }

    public function get($usuarioId = null)
    {
        $portfolio = [];

        // Obtener trabajos
        $trabajoModel = Trabajos::getInstancia();
        $portfolio["trabajos"] = $trabajoModel->getTrabajos($usuarioId);

        // Obtener proyectos
        $proyectoModel = Proyectos::getInstancia();
        $portfolio["proyectos"] = $proyectoModel->getProyectos($usuarioId);

        // Obtener skills
        $skillModel = Skills::getInstancia();
        $portfolio["skills"] = $skillModel->getSkills($usuarioId);

        // Obtener redes sociales
        $redesSocialesModel = RedesSociales::getInstancia();
        $portfolio["redes_sociales"] = $redesSocialesModel->getRedesSociales($usuarioId);
        return $portfolio;
    }
    
    // funcion para obtener todos los datos del portfolio
    public function getPortfolioAll($usuarioId)
    {
        $portfolio = [];

        // Obtener proyectos
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['proyectos'] = $this->rows;

        // Obtener trabajos
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['trabajos'] = $this->rows;

        // Obtener skills
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['skills'] = $this->rows;

        // Obtener redes sociales
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['redes_sociales'] = $this->rows;

        return $portfolio;
    }
    // funcion para editar el portfolio
    public function edit($portfolio = [])
    {
        foreach ($portfolio["trabajos"] as $registros) {
            $trabajoModel = Trabajos::getInstancia();
            $trabajoModel->edit($registros["id"], $registros["titulo"], $registros["descripcion"], $registros["fecha_inicio"], $registros["fecha_final"], $registros["logros"]);
        }
        foreach ($portfolio["proyectos"] as $registros) {
            $proyectoModel = Proyectos::getInstancia();
            $proyectoModel->edit($registros["id"], $registros["titulo"], $registros["descripcion"], $registros["tecnologias"]);
        }
        foreach ($portfolio["skills"] as $registros) {
            $categoriaModel = CategoriasSkill::getInstancia();
            $isExist = $categoriaModel->getCategoria($registros["categorias_skills_categoria"]);
            if (!$isExist) {
                $categoriaModel->setCategoria($registros["categorias_skills_categoria"]);
                $categoriaModel->set();
            }

            $skillModel = Skills::getInstancia();
            $skillModel->edit($registros["id"], $registros["habilidades"], $registros["categorias_skills_categoria"]);
        }
        foreach ($portfolio["redes_sociales"] as $registros) {
            $redesSocialesModel = RedesSociales::getInstancia();
            $redesSocialesModel->edit($registros["id"], $registros["redes_socialescol"], $registros["url"]);
        }
            
    }
    // funcion para borrar el portfolio
    public function delete($usuarioId = null)
    {
        // Borrar proyectos
        $this->query = "DELETE FROM proyectos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();

        // Borrar trabajos
        $this->query = "DELETE FROM trabajos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();

        // Borrar skills
        $this->query = "DELETE FROM skills WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();

        // Borrar redes sociales
        $this->query = "DELETE FROM redes_sociales WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
    }
}