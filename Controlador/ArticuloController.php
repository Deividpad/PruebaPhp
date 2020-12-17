<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

require_once (__DIR__.'/../Modelo/Articulo.php');

if(!empty($_GET['action'])){
    if (empty($_SESSION['idUsuario'])){
        header("Location: ../login.php");
    }
    ArticuloController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
    }

class ArticuloController
{

    static function main($action)
    {

        if ($action == "crear") {
            ArticuloController::crear();
        } else if ($action == "editar") {
            ArticuloController::editar();
        } else if ($action == "eliminar") {
            ArticuloController::eliminar();
        } else if ($action == "gestionarArticulo") {
            ArticuloController::gestionarArticulo();
        }
    }

    static public function gestionarArticulo()
    {
        $arrayArticulo = Articulo::getAll();
        $CodigosArt = "";
        $htmlTable = "";
        if (count($arrayArticulo) >=1) {
            foreach ($arrayArticulo as $Objarticulo) {
                $CodigosArt = $CodigosArt . $Objarticulo->getCodigoArt() . "-";
                $htmlTable .= "<tr>";
                $htmlTable .= "<td style='width: 10%;'>" . $Objarticulo->getCodigoArt() . "</td>";
                $htmlTable .= "<td style='width: 75%;'>" . $Objarticulo->getNombreArt() . "</td>";
                $icons ="";
                $icons .= "<a class='btn btn-round btn-primary' href='EditarArticulo.php?id=".md5($Objarticulo->getId())."' title='Actualizar'><span class='fa fa-edit'></span></a>";
                $icons .= "<a class='btn btn-round btn-danger' title='Eliminar' onclick='Delete(".$Objarticulo->getId().")'><span class='fa fa-trash'></span></a>";
                $htmlTable .= " <td align='center'>$icons</td>";

            }
            $_SESSION['CodigosArt'] = $CodigosArt;
            return $htmlTable;            
        }
        
    }

    static public function crear()
    {
        try {

            $arrayArticulo = array();
            $arrayArticulo['CodigoArt'] = $_POST['txtcodigo'];
            $arrayArticulo['NombreArt'] = $_POST['txtnombre'];
            $arrayArticulo['DescripcionArt'] = $_POST['txtdescipcion'];
            $arrayArticulo['CantidadArt'] = $_POST['txtcantidad'];
            $arrayArticulo['PrecioArt'] = $_POST['txtprecio'];
            $arrayArticulo['EstadoArt'] = $_POST['estado'];

            //imagen
            $fileName = $_POST['txtcodigo'] . '-' . $_POST['txtnombre'] . '.jpg';
            $arrayArticulo['ImagenArt'] = $fileName;                        
            move_uploaded_file($_FILES['txtimagen']['tmp_name'], '../files/' . $fileName);

            
            $articulo = new Articulo($arrayArticulo);            
            $articulo->insertar();
            header("Location: ../index.php?respuesta=ss");
        } catch (Exception $e) {
            header("Location: ../CrearArticulo.php?respuesta=err");
        }
    }

    static public function editar()
    {
        try {
                $arrayArticulo = array();
                $arrayArticulo['CodigoArt'] = $_POST['txtcodigo'];
                $arrayArticulo['NombreArt'] = $_POST['txtnombre'];
                $arrayArticulo['DescripcionArt'] = $_POST['txtdescipcion'];
                $arrayArticulo['CantidadArt'] = $_POST['txtcantidad'];
                $arrayArticulo['PrecioArt'] = $_POST['txtprecio'];
                $arrayArticulo['EstadoArt'] = $_POST['estado'];
                $arrayArticulo['Id'] = $_POST['txtid'];

                //validar si cambio la imagen
                if (!empty(basename($_FILES['txtimagen']['name']))){

                    $fileName = $_POST['txtcodigo'] . '-' . $_POST['txtnombre'] . '.jpg';
                    $arrayArticulo['ImagenArt'] = $fileName;
                    move_uploaded_file($_FILES['txtimagen']['tmp_name'], '../files/' . $fileName);
                    
                }else{
                    $arrayArticulo['ImagenArt'] = $_POST['txtimagennone'];
                }
                
                $articulo = new Articulo($arrayArticulo);
                $articulo->editar();
                header("Location: ../index.php?&respuesta=ss");
        } catch (Exception $e) {
                header("Location: ../EditarArticulo.php?id=" . md5($_POST['txtid']) . "&respuesta=err");            
        }
    }

    static public function eliminar()
    {
        try {
            Articulo::eliminar($_GET['id']);
            header("Location: ../index.php?respuesta=ss");
        } catch (Exception $e) {
            header("Location: ../index.php?respuesta=err");
        }

    }

}






