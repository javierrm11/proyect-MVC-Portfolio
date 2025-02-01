<?php

namespace App\Models;

require_once 'DBAbstractModel.php';

class Proyectos extends DBAbstractModel
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
    private $titulo;
    private $descripcion;
    private $tecnologias;
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
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getTecnologias()
    {
        return $this->tecnologias;
    }
    public function setTecnologias($tecnologias)
    {
        $this->tecnologias = $tecnologias;
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


    public function set(){
        $fecha = new \DateTime();

        $this->query = "INSERT INTO proyectos (titulo, descripcion, tecnologias, visible, created_at, updated_at, usuarios_id) VALUES (:titulo, :descripcion, :tecnologias, :visible, :created_at, :updated_at, :usuarios_id)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['tecnologias'] = $this->tecnologias;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['created_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());;
        $this->parametros['updated_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        $this->mensaje = "Proyecto agregado";
    }
    public function get($id = ''){
        $this->query = "SELECT usuarios_id FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows[0]['usuarios_id'];
    }
    public function getProyectos($id){
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function delete($id = ""){
        $this->query = "DELETE FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Proyecto eliminado";
    }
    
    public function mostrarProyecto($id)
    {
        $this->query = "UPDATE proyectos SET visible = 1 WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }

    public function ocultarProyecto($id)
    {
        $this->query = "UPDATE proyectos SET visible = 0 WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();  
    }
    public function edit(){

    }
}