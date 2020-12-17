<?php
require_once('db_abstract_class.php');

class Articulo extends db_abstract_class
{

    private $Id;
    private $CodigoArt;
    private $NombreArt;
    private $DescripcionArt;
    private $CantidadArt;
    private $PrecioArt;
    private $ImagenArt;
    private $EstadoArt;

    public function __construct($articulo_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($articulo_data)>1){ //
            foreach ($articulo_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->Id = "";
            $this->CodigoArt = "";
            $this->NombreArt = "";
            $this->DescripcionArt = "";
            $this->CantidadArt = "";
            $this->PrecioArt = "";
            $this->ImagenArt = "";
            $this->EstadoArt = "";
        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        // unset($this);
    }
public static function buscarForId($id)
    {
        $articulo = new Articulo();        
        try {
            $getrow = $articulo->getRow("SELECT * FROM articulo WHERE md5(Id) = '". $id . "'");
            $articulo->Id = $getrow['Id'];
            $articulo->CodigoArt = $getrow['CodigoArt'];
            $articulo->NombreArt = $getrow['NombreArt'];
            $articulo->DescripcionArt = $getrow['DescripcionArt'];
            $articulo->CantidadArt = $getrow['CantidadArt'];
            $articulo->PrecioArt = $getrow['PrecioArt'];
            $articulo->ImagenArt = $getrow['ImagenArt'];
            $articulo->EstadoArt = $getrow['EstadoArt'];
            $articulo->Disconnect();
            return $articulo;
        } catch (Exception $e) {
            return NULL;   
        }
    }


    protected static function buscar($query)
    {
        $arrayarticulo = array();
        $tmp = new Articulo();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $articulo = new Articulo();
            $articulo->Id = $valor['Id'];
            $articulo->CodigoArt = $valor['CodigoArt'];
            $articulo->NombreArt = $valor['NombreArt'];
            $articulo->DescripcionArt = $valor['DescripcionArt'];
            $articulo->CantidadArt = $valor['CantidadArt'];
            $articulo->PrecioArt = $valor['PrecioArt'];
            $articulo->ImagenArt = $valor['ImagenArt'];
            $articulo->EstadoArt = $valor['EstadoArt'];
            array_push($arrayarticulo, $articulo);
        }
        $tmp->Disconnect();
        return $arrayarticulo;
    }

    public static function getAll()
    {
        return Articulo::buscar("SELECT * FROM articulo ORDER BY Id");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO pruebadb.articulo VALUES (NULL, ?,?,?,?,?,?,?)", array(

                $this->CodigoArt,
                $this->NombreArt,
                $this->DescripcionArt,
                $this->CantidadArt,
                $this->PrecioArt,
                $this->ImagenArt,
                $this->EstadoArt,
            )

        );

        $this->Disconnect();
    }

    public function editar()
    {
        $this->updateRow("UPDATE pruebadb.articulo SET CodigoArt = ?, NombreArt = ?, DescripcionArt = ?, CantidadArt = ?, PrecioArt = ?, ImagenArt = ?, EstadoArt = ? WHERE Id = ?", array(
            $this->CodigoArt,
            $this->NombreArt,
            $this->DescripcionArt,
            $this->CantidadArt,
            $this->PrecioArt,
            $this->ImagenArt,
            $this->EstadoArt,
            $this->Id,
        ));
        $this->Disconnect();
    }

    public function eliminar($id)
    {        
        $tmp = new Articulo();
        $getrow = $tmp->deleteRow("DELETE FROM articulo WHERE Id = ?", array($id));        
    }

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
    public function getCodigoArt()
    {
        return $this->CodigoArt;
    }

    /**
     * @param string $CodigoArt
     */
    public function setCodigoArt($CodigoArt)
    {
        $this->CodigoArt = $CodigoArt;
    }

    /**
     * @return string
     */
    public function getNombreArt()
    {
        return $this->NombreArt;
    }

    /**
     * @param string $NombreArt
     */
    public function setNombreArt($NombreArt)
    {
        $this->NombreArt = $NombreArt;
    }

    /**
     * @return string
     */
    public function getDescripcionArt()
    {
        return $this->DescripcionArt;
    }

    /**
     * @param string $DescripcionArt
     */
    public function setDescripcionArt($DescripcionArt)
    {
        $this->DescripcionArt = $DescripcionArt;
    }

    /**
     * @return string
     */
    public function getCantidadArt()
    {
        return $this->CantidadArt;
    }

    /**
     * @param string $CantidadArt
     */
    public function setCantidadArt($CantidadArt)
    {
        $this->CantidadArt = $CantidadArt;
    }

    /**
     * @return string
     */
    public function getPrecioArt()
    {
        return $this->PrecioArt;
    }

    /**
     * @param string $PrecioArt
     */
    public function setPrecioArt($PrecioArt)
    {
        $this->PrecioArt = $PrecioArt;
    }

    /**
     * @return string
     */
    public function getImagenArt()
    {
        return $this->ImagenArt;
    }

    /**
     * @param string $ImagenArt
     */
    public function setImagenArt($ImagenArt)
    {
        $this->ImagenArt = $ImagenArt;
    }

    /**
     * @return string
     */
    public function getEstadoArt()
    {
        return $this->EstadoArt;
    }

    /**
     * @param string $EstadoArt
     */
    public function setEstadoArt($EstadoArt)
    {
        $this->EstadoArt = $EstadoArt;
    }





}
