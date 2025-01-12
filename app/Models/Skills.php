<?php

namespace App\Models;

require_once 'DBAbstractModel.php';

class Skills extends DBAbstractModel
{
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
    private $id;
    private $habilidades;
    private $categorias_skills_categoria;
    private $visible;
    private $created_at;
    private $updated_at;
    private $usuarios_id;
    //gets y sets
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getHabilidades()
    {
        return $this->habilidades;
    }
    public function setHabilidades($habilidades)
    {
        $this->habilidades = $habilidades;
    }
    public function getCategoriasSkillsCategoria()
    {
        return $this->categorias_skills_categoria;
    }
    public function setCategoriasSkillsCategoria($categorias_skills_categoria)
    {
        $this->categorias_skills_categoria = $categorias_skills_categoria;
    }
    public function getVisible()
    {
        return $this->visible;
    }
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getUsuariosId()
    {
        return $this->usuarios_id;
    }
    public function setUsuariosId($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }
    



    public function setSkill(){
        $fecha = new \DateTime();

        $this->query = "INSERT INTO skills (habilidades, categorias_skills_categoria, visible, created_at, updated_at, usuarios_id) VALUES (:habilidades, :categorias_skills_categoria, :visible, :created_at, :updated_at, :usuarios_id)";
        $this->parametros['habilidades'] = $this->habilidades;
        $this->parametros['categorias_skills_categoria'] = $this->categorias_skills_categoria;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['created_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());;
        $this->parametros['updated_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        $this->mensaje = "Proyecto agregado";
    }
    public function getUserProyecto($id){
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function getSkills($id){
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function get(){

    }
    public function set(){

    }
    public function edit(){

    }
    public function delete(){

    }
}