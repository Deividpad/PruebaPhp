<?php 
  require("snippers/menusuperior.php");
  require("snippers/menuizquierdo.php");
?>
<!--My Form-->
<div id="content">
  <div class="col-md-12">
    <div class="col-md-12 panel">
      <div class="col-md-12 panel-heading">
        <h4>Crear Articulo
          <button onclick="window.location.href='index.php'" class="btn btn-raised btn-info"><span class="fa fa-arrow-left"></span></button>          
        </h4>
      </div>
      <div class="col-md-12 panel-body" style="padding-bottom:30px;">
        <div class="col-md-12">
          <input type="hidden" id="CodigosArt">
          <form class="cmxform" id="FrmCrearActiculo" method="post" action="Controlador/ArticuloController.php?action=crear" enctype="multipart/form-data">            
            <div class="col-md-6">
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="text" class="form-text" id="txtcodigo" name="txtcodigo" required>
                <span class="bar"></span>
                <label>Codigo</label>
              </div>

              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="number" class="form-text" id="txtcantidad" name="txtcantidad" required>
                <span class="bar"></span>
                <label>Cantidad</label>
              </div> 

              <div class="form-group form-animate-text" style="margin-top:40px !important;">                              
                <input type="file" class="form-control-file" id="txtimagen" name="txtimagen" accept="image/jpeg" title="Imagen con formato deferente a .jpeg no será guardada">
                Solo formato .jpg (Max 1MB)
                <span class="bar"></span>
              </div>

              <div class="form-group form-animate-text" style="margin-top:-34px !important;">
                  <img style="height: 200px; width: 200px;" id="showimg" name="showimg">
              </div>    
            </div>

            <div class="col-md-6">
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="text" class="form-text" id="txtnombre" name="txtnombre" required>
                <span class="bar"></span>
                <label>Nombre</label>
              </div>

              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="number" class="form-text" id="txtprecio" name="txtprecio" required>
                <span class="bar"></span>
                <label>Precio</label>
              </div>

              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <span class="bar"></span>
                <select id="estado" name="estado" class="form-control">
                  <option selected="" value="1">Activado</option>
                  <option value="0">Desactivado</option>
                </select>
              </div>

              <div class="form-group form-animate-text" style="margin-top:-28px !important;">
                <textarea class="form-control" id="txtdescipcion" name="txtdescipcion" rows="9" cols="2" height  placeholder="Descripción" required="required" style="resize: none;" ></textarea>
                <span class="bar"></span>
                <label></label>
              </div> 
              <div style="text-align: center;">
                <button class="btn btn-raised btn-primary" id="btnGuardar" name="btnGuardar">Guardar <span class="glyphicon glyphicon-saved"></span></button>
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
    $("#FrmCrearActiculo").validate({
      errorElement: "em",
      errorPlacement: function(error, element) {
        $(element.parent("div").addClass("form-animate-error"));
        error.appendTo(element.parent("div"));
      },
      success: function(label) {
        $(label.parent("div").removeClass("form-animate-error"));
      },
      rules: {
        txtimagen: "required",
        
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
        txtimagen: "Por favor ingrese imagen del artículo",

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
      if (sParametro[1] == "err"){
        alertify.error('Error en la operación');
      }
    } 
    
    $("#txtimagen").change(function() {

      //validar si tiene la extensión
      if (this.files[0]['name'].indexOf(".jpg") > 0){

        //validar si no supera el tamaño a 1MB
        if (this.files[0]['size'] <= (400 * 1024)){
          readURL(this);
        }else{
          alertify.error('Supera el tamaño a 1MB');
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

    //enviar formulario y validar que el código del artículo no exista
    $("#btnGuardar").click(function() {            
      //CodigosArtSplit = todos los codigos que hay en la base de datos
      var CodigosArtSplit = $("#CodigosArt").val().split("-");
      var CodigoArt = $("#txtcodigo").val();
      var existe = 0;
      if (CodigosArt != 0 && CodigoArt != ""){
        for (var i = 0; i < CodigosArtSplit.length - 1; i ++){
          if (CodigosArtSplit[i] == CodigoArt){
            existe = 1;
            alertify.error('El código del artículo ya existe');
            break;
          }
        }        
      }
    });
  });
</script>
<!-- end: Javascript -->