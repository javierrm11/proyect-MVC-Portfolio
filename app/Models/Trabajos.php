<?php

namespace App\Models;

require_once 'DBAbstractModel.php';

class Trabajos extends DBAbstractModel
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
    private $fecha_inicio;
    private $fecha_final;
    private $logros;
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
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }
    public function getFechaFinal()
    {
        return $this->fecha_final;
    }
    public function setFechaFinal($fecha_final)
    {
        $this->fecha_final = $fecha_final;
    }
    public function getLogros()
    {
        return $this->logros;
    }
    public function setLogros($logros)
    {
        $this->logros = $logros;
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
    
    // funcion para crear un nuevo trabajo en la base de datos
    public function setTrabajo(){
        $fecha = new \DateTime();

        $this->query = "INSERT INTO trabajos (titulo, descripcion, fecha_inicio, fecha_final, logros, visible, created_at, updated_at, usuarios_id) VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_final, :logros, :visible, :created_at, :updated_at, :usuarios_id)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['fecha_inicio'] = $this->fecha_inicio;
        $this->parametros['fecha_final'] = $this->fecha_final;
        $this->parametros['logros'] =  $this->logros;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['created_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());;
        $this->parametros['updated_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        $this->mensaje = "Trabajo agregado";
    }

    // funcion para obtener el usuario que creo el trabajo
    public function getUserTrabajo($id){
        $this->query = "SELECT usuarios_id FROM trabajos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows["0"]["usuarios_id"];
    }
    // funcion para obtener los trabajos de un usuario
    public function getTrabajos($id){
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    // funcion para obtener un trabajo en especifico
    public function updateTrabajo($trabajoId, $titulo, $descripcion, $fecha_inicio, $fecha_fin, $logros){
        $fecha = new \DateTime();
        $this->query = "UPDATE trabajos SET titulo = :titulo, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_final = :fecha_final, logros = :logros, updated_at = :updated_at WHERE id = :id";
        $this->parametros['titulo'] = $titulo;
        $this->parametros['descripcion'] = $descripcion;
        $this->parametros['fecha_inicio'] = $fecha_inicio;
        $this->parametros['fecha_final'] = $fecha_fin;
        $this->parametros['logros'] = $logros;
        $this->parametros['updated_at'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $trabajoId;
        $this->get_results_from_query();
        $this->mensaje = "Trabajo actualizado";
    }
    // funcion para eliminar un trabajo
    public function deleteTrabajo($id){
        $this->query = "DELETE FROM trabajos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Trabajo eliminado";
    }
    public function mostrarTrabajo($id)
    {
        $this->query = "UPDATE trabajos SET visible = 1 WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }

    public function ocultarTrabajo($id)
    {
        $this->query = "UPDATE trabajos SET visible = 0 WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query(); 
    }
    public function get(){

    }
    public function set(){

    }
    public function edit(){

    }
    public function delete(){}
}