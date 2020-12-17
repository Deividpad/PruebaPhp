<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="asset/css/plugins/alertify.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">

      <div class="container">

        <form class="form-signin" >
          <div class="panel periodic-login">
              <span class="atomic-number">28</span>
              <div class="panel-body text-center">
                  <h1 class="atomic-symbol">SW</h1>
                  <p class="atomic-mass">Prueba</p>
                  <p class="element-name">Desarrollo</p>

                  <i class="icons icon-arrow-down"></i>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" id="User" name="User" required>
                    <span class="bar"></span>
                    <label>Usuario</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" id="Password" name="Password" required>
                    <span class="bar"></span>
                    <label>Contraseña</label>
                  </div>
                  <input  id="btnEnviar" name="btn" class="btn col-md-12" value="Ingresar"/>
              </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
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


      <!-- custom -->
      <script src="asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){        
         $("#btnEnviar").click(function(e) {
            var User = $("#User").val();
            var Password = $("#Password").val();

            if (User === "" || Password ===""){
              alertify.error('Complete los campos.');
            }else{
              $.ajax({
                  method: "POST",
                  url: "Controlador/LoginController.php?action=Login",
                  data: { User: User, Password: Password}
              }).done(function( msg ) {
                if(msg == "1"){
                    window.location.href = "index.php";
                }else{
                  alertify.error(msg);
                }
              });
            }
          });          
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>