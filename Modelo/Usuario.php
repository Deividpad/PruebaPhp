<?php
require_once('db_abstract_class.php');
/**
 * Created by PhpStorm.
 * User: yeimy
 * Date: 10/07/2017
 * Time: 12:29 PM
 */
class Usuario extends db_abstract_class
{

    private $Id;
    private $usuario;
    private $contrasena;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getusuario()
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setusuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getcontrasena()
    {
        return $this->contrasena;
    }

    /**
     * @param string $contrasena
     */
    public function contrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    public function __construct($usuario_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($usuario_data)>1){ //
            foreach ($usuario_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->usuario = "";
            $this->contrasena = "";
        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }    

    public function insertar(){
    }

    public function editar(){
    }

    public function eliminar($id){

    }

    public static function buscarForId($id){
        
    }

    public static function getAll(){
        return usuarios::buscar("SELECT * FROM usuarios");
    }

    public static function buscar($query){
    }

    public static function Login($User, $Password){
        $arrUsuarios = array();
        $tmp = new Usuario();

        $getTempUser = $tmp->getRows("SELECT * FROM usuarios WHERE usuario = '$User' AND contrasena = '$Password'");        
        if(count($getTempUser) >= 1){                        
                foreach ($getTempUser as $valor) {
                    return $valor;
                }            
        }else{
            return "Usuario o Contraseña Incorrecto";
        }
        $tmp->Disconnect();
        return $arrUsuarios;
    }    
}