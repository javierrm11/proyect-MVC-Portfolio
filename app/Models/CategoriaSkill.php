<?php

namespace App\Models;

require_once 'DBAbstractModel.php';

class CategoriasSkill extends DBAbstractModel
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
    private $categoria;
    //gets y sets
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    // funcion para añañir una categoria
    public function set(){
        $this->query = "INSERT INTO categorias_skills (categoria) VALUES (:categoria)";
        $this->parametros['categoria'] = $this->categoria;
        $this->get_results_from_query();
        $this->mensaje = "Categoria creada";   
    }
    // funcion para obtener la categoria por nombre
    public function get($categoria = ''){
        $this->query = "SELECT * FROM categorias_skills where categoria = :categoria";
        $this->parametros['categoria'] = $categoria;
        $this->get_results_from_query();

    }
    public function delete($id = ""){
        
    }
    
    public function edit(){

    }
}