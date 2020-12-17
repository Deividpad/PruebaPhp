<?php 
  require("snippers/menusuperior.php");
  require("snippers/menuizquierdo.php");
?>
<div id="content">
  <div class="panel box-shadow-none content-header">
    <div class="panel-body">
      <div class="col-md-12">
          <h3 class="animated fadeInLeft">Home</h3>
          <p class="animated fadeInDown">
            Home <span class="fa-angle-right fa"></span> Artículos
          </p>
          <div class="col-md-12"></div>
      </div>
    </div>
  </div>
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-10">
              <h3>ARTÍCULOS</h3>
            </div>
            <div class="col-md-2 top-20 padding-0" style="text-align-last: center;">
              <button onclick="window.location.href='CrearArticulo.php'" class="btn btn-raised btn-success">Nuevo <span class="fa fa-plus"></span></button>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  echo ArticuloController::gestionarArticulo();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>  

<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="asset/js/plugins/alertify.min.js"></script>
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.datatables.min.js"></script>
<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>
<script src="asset/js/main.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();

    var sPaginaURL = window.location.search.substring(1);
    var sURLVariables = sPaginaURL.split('?');
    if (sURLVariables.length > 0){
      var sParametro = sURLVariables[0].split('=');
      if (sParametro[1] == "ss"){
        alertify.success('Operación exitosa');
      }else if (sParametro[1] == "err" ){
        alertify.error('Error en la operación');
      }
    } 
  });

  function Delete(id) {
    alertify.confirm("Desea eliminar el registro?",
    function(){
      window.location.href = "Controlador/ArticuloController.php?action=eliminar&id=" + id;
    },
    function(){
    });
  }
</script>
<!-- end: Javascript -->
</body>
</html>