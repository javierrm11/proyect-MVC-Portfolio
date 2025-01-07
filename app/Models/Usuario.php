<?php
# Importar modelo de abstracción de base de datos
namespace App\Models;
require_once("DBAbstractModel.php");
class Usuario extends DBAbstractModel{
    /*CONSTRUCCIÓN DEL MODELO SINGLETON*/
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
    private $id;
    private $nombre;
    private $apellidos;
    private $foto;
    private $categoria_profesional;
    private $email;
    private $resumen_perfil;
    private $password;
    private $visible;
    private $created_at;
    private $updated_at;
    private $token;
    private $fecha_creacion_token;
    private $cuenta_activa;

    //getters y setters
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function getCategoriaProfesional()
    {
        return $this->categoria_profesional;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getResumenPerfil()
    {
        return $this->resumen_perfil;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getVisible()
    {
        return $this->visible;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function getToken()
    {
        return $this->token;
    }
    public function getFechaCreacionToken()
    {
        return $this->fecha_creacion_token;
    }
    public function getCuentaActiva()
    {
        return $this->cuenta_activa;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
    public function setFoto($foto) {
        $this->foto = $foto;
    }
    public function setCategoriaProfesional($categoria_profesional) {
        $this->categoria_profesional = $categoria_profesional;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setResumenPerfil($resumen_perfil) {
        $this->resumen_perfil = $resumen_perfil;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setVisible($visible) {
        $this->visible = $visible;
    }
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }
    public function setToken($token) {
        $this->token = $token;
    }
    public function setFechaCreacionToken($fecha_creacion_token) {
        $this->fecha_creacion_token = $fecha_creacion_token;
    }
    public function setCuentaActiva($cuenta_activa) {
        $this->cuenta_activa = $cuenta_activa;
    }

    //mensaje
    public function getMensaje()
    {
        return $this->mensaje;
    }
    public function getAll(){
        $this->query = "SELECT * FROM usuarios where cuenta_activa = 1";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            return $this->rows;
        }
        
    }

    public function get($correo = ""){
        $this->query = "SELECT id FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $correo;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }
    }
    public function getT($token)
    {
        $this->query = "SELECT * FROM usuarios WHERE token = :token";
        $this->parametros['token'] = $token;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function set(){
        $this->query = "INSERT INTO usuarios(nombre, apellidos, foto, categoria_profesional, email, resumen_perfil, password, visible, created_at, updated_at, token, fecha_creacion_token, cuenta_activa) VALUES(:nombre, :apellidos, :foto, :categoria_profesional, :email, :resumen_perfil, :password, :visible, :created_at, :updated_at, :token, :fecha_creacion_token, :cuenta_activa)";
        
        //$this->parametros['id']= $id;
        $this->parametros['nombre']= $this->nombre;
        $this->parametros['apellidos']= $this->apellidos;
        $this->parametros['foto']= $this->foto;
        $this->parametros['categoria_profesional']= $this->categoria_profesional;
        $this->parametros['email']= $this->email;
        $this->parametros['resumen_perfil']= $this->resumen_perfil;
        $this->parametros['password']= $this->password;
        $this->parametros['visible']= $this->visible;
        $this->parametros['created_at']= $this->created_at;
        $this->parametros['updated_at']= $this->updated_at;
        $this->parametros['token']= $this->token;
        $this->parametros['fecha_creacion_token']= $this->fecha_creacion_token;
        $this->parametros['cuenta_activa']= $this->cuenta_activa;

        var_dump($this->query);
        $this->get_results_from_query();
        //$this->execute_single_query();
        $this->mensaje = 'Usuario añadido.';
    }
    
    
    public function delete(){}
    public function edit(){}
    public function editCuentaActiva(){
        $this->query = "UPDATE usuarios 
        SET cuenta_activa = 1 WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Cuenta activada con éxito. Ahora puedes iniciar sesión.';
    }
}