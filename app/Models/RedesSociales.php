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
    public function getRedesSociales($id){
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function get(){}
    public function set(){}

    public function edit(){}
    public function delete(){}
}