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

        $categoriaModel = CategoriasSkill::getInstancia();
        $isExist = $categoriaModel->getCategoria($data['categoria']);
        if (!$isExist) {
            $categoriaModel->setCategoria($data['categoria']);
            $categoriaModel->set();
        }
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

    public function getPortfolio($usuarioId)
    {
        $portfolio = [];

        // Obtener proyectos
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['proyectos'] = $this->rows;

        // Obtener trabajos
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['trabajos'] = $this->rows;

        // Obtener skills
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id AND visible = 1";
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
    public function get($usuarioId = null){
        $portfolio = [];

        // Obtener proyectos
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['proyectos'] = $this->rows;

        // Obtener trabajos
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['trabajos'] = $this->rows;

        // Obtener skills
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id AND visible = 1";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['skills'] = $this->rows;

        // Obtener redes sociales
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['redes_sociales'] = $this->rows;

        $this->query = "SELECT * FROM usuarios WHERE id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarioId;
        $this->get_results_from_query();
        $portfolio['usuario'] = $this->rows;

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
        foreach ($portfolio as $tabla => $registros) {
            foreach ($registros as $campos) {
                $this->query = "UPDATE $tabla SET ";
                $i = 0;
                foreach ($campos as $campo => $valor) {
                    if ($campo != 'id') {
                        $this->query .= "$campo = :$campo";
                        $this->parametros[$campo] = $valor;
                        $i++;
                        if ($i < count($campos) - 1) {
                            $this->query .= ", ";
                        }
                    }
                }
                $this->query .= " WHERE id = :id";
                $this->parametros['id'] = $campos['id'];
                $this->get_results_from_query();
            }
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