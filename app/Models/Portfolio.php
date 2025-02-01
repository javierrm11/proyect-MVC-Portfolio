<?php

namespace App\Models;

require_once 'DBAbstractModel.php';

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
    public function setPortfolio($data)
    {
        // Guardar proyectos
        $this->query = "INSERT INTO proyectos(titulo, descripcion, tecnologias, visible, created_at, updated_at, usuarios_id) VALUES(:titulo, :descripcion, :tecnologias, :visible, :created_at, :updated_at, :usuarios_id)";
        $this->parametros['titulo'] = $data['tituloProyectos'];
        $this->parametros['descripcion'] = $data['descripcionProyectos'];
        $this->parametros['tecnologias'] = $data['tecnologiasProyectos'];
        $this->parametros['visible'] = 1;
        $this->parametros['created_at'] = date("Y-m-d H:i:s");
        $this->parametros['updated_at'] = date("Y-m-d H:i:s");
        $this->parametros['usuarios_id'] = $data['usuarioId'];
        $this->get_results_from_query();

        // Guardar trabajos
        $this->query = "INSERT INTO trabajos(titulo, descripcion, fecha_inicio, fecha_final, logros, visible, created_at, updated_at, usuarios_id) VALUES(:titulo, :descripcion, :fecha_inicio, :fecha_final, :logros, :visible, :created_at, :updated_at, :usuarios_id)";
        $this->parametros['titulo'] = $data['tituloTrabajos'];
        $this->parametros['descripcion'] = $data['descripcionTrabajos'];
        $this->parametros['fecha_inicio'] = $data['fecha_inicioTrabajos'];
        $this->parametros['fecha_final'] = $data['fecha_finTrabajos'];
        $this->parametros['logros'] = $data['logrosTrabajos'];
        $this->parametros['visible'] = 1;
        $this->parametros['created_at'] = date("Y-m-d H:i:s");
        $this->parametros['updated_at'] = date("Y-m-d H:i:s");
        $this->parametros['usuarios_id'] = $data['usuarioId'];
        $this->get_results_from_query();

        // guaradar categoria-skill
        $this->query = "INSERT INTO categorias_skills(categoria) VALUES(:categoria)";
        $this->parametros['categoria'] = $data['categoria'];
        $this->get_results_from_query();

        // Guardar skills
        $this->query = "INSERT INTO skills(habilidades, visible, created_at, updated_at, categorias_skills_categoria, usuarios_id) VALUES(:habilidades, :visible, :created_at, :updated_at, :categorias_skills_categoria, :usuarios_id)";
        $this->parametros['habilidades'] = $data['habilidades'];
        $this->parametros['visible'] = 1;
        $this->parametros['created_at'] = date("Y-m-d H:i:s");
        $this->parametros['updated_at'] = date("Y-m-d H:i:s");
        $this->parametros['categorias_skills_categoria'] = $data['categoria'];
        $this->parametros['usuarios_id'] = $data['usuarioId'];
        $this->get_results_from_query();

        // Guardar redes sociales
        $redesSociales = ['facebook', 'twitter', 'linkedin', 'github', 'instagram'];
        foreach ($redesSociales as $red) {
            $this->query = "INSERT INTO redes_sociales(redes_socialescol, url, usuarios_id) VALUES(:redes_socialescol, :url, :usuarios_id)";
            $this->parametros['redes_socialescol'] = $red;
            $this->parametros['url'] = $data[$red];
            $this->parametros['usuarios_id'] = $data['usuarioId'];
            $this->get_results_from_query();
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
    public function getPortfolioUser($usuarioId){
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
    //funciones para obtener el id del usuario
    public function getUserTrabajo($id){
        $this->query = "SELECT usuarios_id FROM trabajos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows[0]['usuarios_id'];
    }
    public function getUserProyecto($id){
        $this->query = "SELECT usuarios_id FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows[0]['usuarios_id'];
    }
    public function getUserSkill($id){
        $this->query = "SELECT usuarios_id FROM skills WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows[0]['usuarios_id'];
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
    public function editPortfolio($portfolio)
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
    public function deletePortfolio($usuarioId)
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
    //funciones para mostrar y ocultar los trabajos, proyectos y skills
    
    public function mostrarSkill($id)
    {
        $this->query = "UPDATE skills SET visible = 1 WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }

    public function ocultarSkill($id)
    {
        $this->query = "UPDATE skills SET visible = 0 WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();   
    }

    public function get(){}
    public function set(){}
    public function edit(){}
    public function delete(){}
}