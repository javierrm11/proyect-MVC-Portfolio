<?php

namespace App\Models;

require_once 'DBAbstractModel.php';

class RedesSociales extends DBAbstractModel
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

    private $id;
    private $redes_socialescol;
    private $url;
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
    public function getRedesSocialescol()
    {
        return $this->redes_socialescol;
    }
    public function setRedesSocialescol($redes_socialescol)
    {
        $this->redes_socialescol = $redes_socialescol;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function setUrl($url)
    {
        $this->url = $url;
    }
    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }
    // funcion para obtener una red social
    public function get($id = ""){
        $this->query = "SELECT usuarios_id FROM redes_sociales WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows[0]["usuarios_id"];
    }
    // funcion para obtener todas las redes sociales
    public function getRedesSociales($id){
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    // funcion para agregar redes sociales
    public function set()
    {
        $this->query = "INSERT INTO redes_sociales (redes_socialescol, url, created_at, updated_at, usuarios_id) VALUES (:redes_socialescol, :url, :created_at, :updated_at, :usuarios_id)";
        $this->parametros['redes_socialescol'] = $this->redes_socialescol;
        $this->parametros['url'] = $this->url;
        $this->parametros['created_at'] = $this->created_at;
        $this->parametros['updated_at'] = $this->updated_at;
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
    }
    // funcion para editar redes sociales
    public function edit(){
        $this->query = "UPDATE redes_sociales SET redes_socialescol = :redes_socialescol, url = :url WHERE id = :id";
        $this->parametros['redes_socialescol'] = $this->redes_socialescol;
        $this->parametros['url'] = $this->url;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }
    // funcion para eliminar redes sociales
    public function delete(){
        $this->query = "DELETE FROM redes_sociales WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }
}