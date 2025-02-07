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
    private $portfolio;
    private $trabajo;
    private $proyecto;
    private $skill;
    private $redes_sociales;

    //gets y sets
    public function getPortfolio()
    {
        return $this->portfolio;
    }
    public function setPortfolio($portfolio)
    {
        $this->portfolio = $portfolio;
    }
    public function getTrabajo()
    {
        return $this->trabajo;
    }
    public function setTrabajo($trabajo)
    {
        $this->trabajo = $trabajo;
    }
    public function getProyecto()
    {
        return $this->proyecto;
    }
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;
    }
    public function getSkill()
    {
        return $this->skill;
    }
    
    public function setSkill($skill)
    {
        $this->skill = $skill;
    }
    public function getRedesSociales()
    {
        return $this->redes_sociales;
    }
    public function setRedesSociales($redes_sociales)
    {
        $this->redes_sociales = $redes_sociales;
    }
    public function set()
    {
        // Guardar proyectos
        $trabajoModel = Trabajos::getInstancia();
        $trabajoModel->setTitulo($this->trabajo['titulo']);
        $trabajoModel->setDescripcion($this->trabajo['descripcion']);
        $trabajoModel->setFechaInicio($this->trabajo['fecha_inicio']);
        $trabajoModel->setFechaFinal($this->trabajo['fecha_final']);
        $trabajoModel->setLogros($this->trabajo['logros']);
        $trabajoModel->setVisible(1);
        $trabajoModel->setUsuariosId($this->trabajo['usuarioId']);
        $trabajoModel->set();

        // Guardar trabajos
        $proyectoModel = Proyectos::getInstancia();
        $proyectoModel->setTitulo($this->proyecto['titulo']);
        $proyectoModel->setDescripcion($this->proyecto['descripcion']);
        $proyectoModel->setTecnologias($this->proyecto['tecnologias']);
        $proyectoModel->setVisible(1);
        $proyectoModel->setCreatedAt(date("Y-m-d H:i:s"));
        $proyectoModel->setUpdatedAt(date("Y-m-d H:i:s"));
        $proyectoModel->setUsuariosId($this->proyecto['usuarioId']);
        $proyectoModel->set();

        // Guardar skills
        $skillModel = Skills::getInstancia();
        $categoriaModel = CategoriasSkill::getInstancia();
        $isExist = $categoriaModel->get($this->skill['categorias_skills_categoria']);
        if (!$isExist) {
            $categoriaModel->setCategoria($this->skill['categorias_skills_categoria']);
            $categoriaModel->set();
        }
        $skillModel->setHabilidades($this->skill['habilidades']);
        $skillModel->setCategoriasSkillsCategoria($this->skill['categorias_skills_categoria']);
        $skillModel->setVisible(1);
        $skillModel->setCreatedAt(date("Y-m-d H:i:s"));
        $skillModel->setUpdatedAt(date("Y-m-d H:i:s"));
        $skillModel->setUsuariosId($this->skill['usuarioId']);
        $skillModel->set();
        
        // Guardar redes sociales
        $redesSociales = ['facebook', 'twitter', 'linkedin', 'github', 'instagram'];
        foreach ($redesSociales as $red) {
            $redesSocialesModel = RedesSociales::getInstancia();
            $redesSocialesModel->setRedesSocialescol($red);
            $redesSocialesModel->setUrl($this->redes_sociales[$red]);
            $redesSocialesModel->setUsuarios_id($this->redes_sociales['usuarioId']);
            $redesSocialesModel->set();
        }
    }

    public function get($usuarioId = null)
    {
        $portfolio = [];

        // Obtener trabajos
        $trabajoModel = Trabajos::getInstancia();
        $portfolio["trabajos"] = $trabajoModel->getTrabajosVisibles($usuarioId);

        // Obtener proyectos
        $proyectoModel = Proyectos::getInstancia();
        $portfolio["proyectos"] = $proyectoModel->getProyectosVisibles($usuarioId);

        // Obtener skills
        $skillModel = Skills::getInstancia();
        $portfolio["skills"] = $skillModel->getSkillsVisibles($usuarioId);

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
    public function edit()
    {
        // recorrer los datos del portfolio y actualizarlos
        foreach ($this->portfolio["trabajos"] as $registros) {
            $trabajoModel = Trabajos::getInstancia();
            $trabajoModel->setId($registros["id"]);
            $trabajoModel->setTitulo($registros["titulo"]);
            $trabajoModel->setDescripcion($registros["descripcion"]);
            $trabajoModel->setFechaInicio($registros["fecha_inicio"]);
            $trabajoModel->setFechaFinal($registros["fecha_final"]);
            $trabajoModel->setLogros($registros["logros"]);
            $trabajoModel->edit();
        }
        foreach ($this->portfolio["proyectos"] as $registros) {
            $proyectoModel = Proyectos::getInstancia();
            $proyectoModel->setId($registros["id"]);
            $proyectoModel->setTitulo($registros["titulo"]);
            $proyectoModel->setDescripcion($registros["descripcion"]);
            $proyectoModel->setTecnologias($registros["tecnologias"]);
            $proyectoModel->edit();
        }
        foreach ($this->portfolio["skills"] as $registros) {
            $categoriaModel = CategoriasSkill::getInstancia();
            $isExist = $categoriaModel->getCategoria($registros["categorias_skills_categoria"]);
            if (!$isExist) {
                $categoriaModel->setCategoria($registros["categorias_skills_categoria"]);
                $categoriaModel->set();
            }

            $skillModel = Skills::getInstancia();
            $skillModel->setId($registros["id"]);
            $skillModel->setHabilidades($registros["habilidades"]);
            $skillModel->setCategoriasSkillsCategoria($registros["categorias_skills_categoria"]);
            $skillModel->edit();
        }
        foreach ($this->portfolio["redes_sociales"] as $registros) {
            $redesSocialesModel = RedesSociales::getInstancia();
            $redesSocialesModel->setId($registros["id"]);
            $redesSocialesModel->setRedesSocialescol($registros["redes_socialescol"]);
            $redesSocialesModel->setUrl($registros["url"]);
            $redesSocialesModel->edit();
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