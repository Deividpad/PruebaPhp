<?php 
  require("snippers/menusuperior.php");
  require("snippers/menuizquierdo.php");
  require_once (__DIR__.'/Modelo/Articulo.php');  
  if(!empty($_GET["id"]) && isset($_GET["id"])) {
    $ObjArticulo = Articulo::buscarForId($_GET["id"]);
  }
?>

<!--My Form-->
<div id="content">    
    <div class="col-md-12">
      <div class="col-md-12 panel">
        <div class="col-md-12 panel-heading">
          <h4>Editar Articulo
            <button onclick="window.location.href='index.php'" class="btn btn-raised btn-info">Atras <span class="fa fa-arrow-left"></span></button>            
          </h4>
        </div>
        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
          <div class="col-md-12">
            <input type="hidden" id="CodigoBaseDatos" value="<?php echo $ObjArticulo->getCodigoArt(); ?>">
            <input type="hidden" id="CodigosArt">
            <form class="cmxform" id="FrmEditarActiculo" method="post" action="Controlador/ArticuloController.php?action=editar" enctype="multipart/form-data">                          
              <input type="hidden" id="txtid" name="txtid" value="<?php echo $ObjArticulo->getId(); ?>">
              <div class="col-md-6">
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                  <input type="text" class="form-text" id="txtcodigo" name="txtcodigo" value="<?php echo $ObjArticulo->getCodigoArt(); ?>" required>
                  <span class="bar"></span>
                  <label>Codigo</label>
                </div>

                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                  <input type="number" class="form-text" id="txtcantidad" name="txtcantidad" value="<?php echo $ObjArticulo->getCantidadArt(); ?>" required>
                  <span class="bar"></span>
                  <label>Cantidad</label>
                </div> 

                <input type="hidden" id="txtimagennone" name="txtimagennone" value="<?php echo $ObjArticulo->getImagenArt(); ?>" >                            
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                  <input type="file" class="form-control-file" id="txtimagen" name="txtimagen" accept="image/jpeg" value="<?php echo $ObjArticulo->getImagenArt(); ?>" title="Imagen con formato deferente a .jpeg no será editada">
                  Solo formato .jpeg (Max 1MB)
                  <span class="bar"></span>
                </div>

                <div class="form-group form-animate-text" style="margin-top:-34px !important;">
                  <img style="height: 200px; width: 200px;" id="showimg" name="showimg" src="files/<?php echo $ObjArticulo->getImagenArt(); ?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                  <input type="text" class="form-text" id="txtnombre" name="txtnombre" value="<?php echo $ObjArticulo->getNombreArt(); ?>" required>
                  <span class="bar"></span>
                  <label>Nombre</label>
                </div>

                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                  <input type="number" class="form-text" id="txtprecio" name="txtprecio" value="<?php echo $ObjArticulo->getPrecioArt(); ?>" required>
                  <span class="bar"></span>
                  <label>Precio</label>
                </div>

                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                  <select id="estado" name="estado" class="form-control">
                    <?php if ($ObjArticulo->getEstadoArt() == 0 || empty($ObjArticulo->getEstadoArt())) { ?>
                      <option value="1">Activado</option>
                      <option selected="selected" value="0">Desactivado</option>
                    <?php }else{ ?>                                  
                      <option selected="selected" value="1">Activado</option>
                      <option value="0">Desactivado</option>
                    <?php } ?>                                
                  </select>
                </div>

                <div class="form-group form-animate-text" style="margin-top:-28px !important;">
                  <textarea class="form-control" id="txtdescipcion" name="txtdescipcion" rows="9" cols="2" placeholder="Descripción" required="required" style="resize: vertical;"><?php echo $ObjArticulo->getDescripcionArt(); ?></textarea>
                  <span class="bar"></span>
                  <label></label>
                </div>
                <div style="text-align: center;">
                <button class="btn btn-raised btn-primary" id="btnModificar" name="btnModificar">Modificar <span class="fa fa-wrench"></span></button>                      
                </div>
              </div>                   
          </form>
        </div>
      </div>
    </div>              
  </div>
  <!--End My Form-->
            

<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<!-- plugins -->
<script src="asset/js/plugins/alertify.min.js"></script>
<script src="asset/js/plugins/jquery.validate.min.js"></script>
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>
<script src="asset/js/main.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var CodigosArt = "<?php
        if (!isset($_SESSION["CodigosArt"])){
            echo 0;
        }else{
            echo $_SESSION["CodigosArt"];
        }?>";    
    $("#CodigosArt").val(CodigosArt);

    //validaciones
    $("#FrmEditarActiculo").validate({
      errorElement: "em",
      errorPlacement: function(error, element) {
        $(element.parent("div").addClass("form-animate-error"));
        error.appendTo(element.parent("div"));
      },
      success: function(label) {
        $(label.parent("div").removeClass("form-animate-error"));
      },
      rules: {
        
        txtcodigo: {
          required: true,
          minlength: 1,
          maxlength: 50,
        },

        txtnombre: {
          required: true,
          minlength: 1,
          maxlength: 50,
        },

        txtcantidad: {
          required: true,
          minlength: 1,
          maxlength: 10,
          min: 1,
          max: 999999999,
        },

        txtprecio: {
          required: true,
          minlength: 1,
          maxlength: 10,
          min: 1,
          max: 999999999,
        },

        txtdescipcion: {
          required: true,
          minlength: 1,
          maxlength: 1000,
        },

      },
      messages: {

        txtcodigo:{
          required: "Por favor ingrese el código del artículo",
          minlength: "Por favor ingrese el código del artículo",
          maxlength: "Demesiados caracteres para el código"
        },

        txtnombre:{
          required: "Por favor ingrese el nombre del artículo",
          minlength: "Por favor ingrese el nombre del artículo",
          maxlength: "Demesiados caracteres para el nombre"
        },

        txtcantidad:{
          required: "Por favor ingrese cantidad del artículo",
          minlength: "Cantidad no soportada",
          maxlength: "Cantidad no soportada",
          min: "Debe ser mayor a 0",
          max: "Cantidada demasiado grande"
        },

        txtprecio:{
          required: "Por favor ingrese precio del artículo",
          minlength: "Precio no soportado",
          maxlength: "Precio no soportado",
          min: "Debe ser mayor a 0",
          max: "Precio demasiado grande "
        },

        txtdescipcion:{
          required: "Por favor ingrese la descripción del artículo",
          minlength: "Por favor ingrese la descripción del artículo",
          maxlength: "Demesiados caracteres para la descripción"
        },
      }
    });

    var sPaginaURL = window.location.search.substring(1);
    var sURLVariables = sPaginaURL.split('?');
    if (sURLVariables.length > 0){
      var sParametro = sURLVariables[0].split('=');
      if (sParametro[2] == "err"){
        alertify.error('Error en la operación');
      }
    }

    //mostrar imagen
    $("#txtimagen").change(function() {
        //validar si tiene la extensión
        if (this.files[0]['name'].indexOf(".jpg") > 0){

        //validar si no supera el tamaño a 1MB
        if (this.files[0]['size'] <= (400 * 1024)){
          readURL(this);
        }else{
          alertify.error('No debe superar el tamaño a 1MB');
        }        
      }else{
        alertify.error('Error en el formato del archivo');
      }
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#showimg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    //enviar formulario
    $("#btnModificar").click(function(e) {      
      //CodigosArtSplit = todos los codigos que hay en la base de datos
      var CodigosArtSplit = $("#CodigosArt").val().split("-");
      var CodigoArt = $("#txtcodigo").val();
      var CodigoBaseDatos = $("#CodigoBaseDatos").val();      

      if (CodigoBaseDatos != CodigoArt && CodigoArt != ""){
        for (var i = 0; i < CodigosArtSplit.length - 1; i ++){
          if (CodigosArtSplit[i] == CodigoArt){
            alertify.error('El código del artículo ya existe');
            e.preventDefault();
            break;
          }
        }
      }      
    });

    //validar si el IdGet existe
    if ($("#txtid").val() == ""){
      alertify.error('Articulo no existe');
      setTimeout(
        function(){
            window.location = "index.php";
        },2000);
    } 
  });

</script>
<!-- end: Javascript -->
</body>
</html>
