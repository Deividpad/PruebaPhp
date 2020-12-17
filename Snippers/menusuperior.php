<?php 
session_start();
if (empty($_SESSION['idUsuario'])){
   header("Location: login.php");
}else
require "Controlador/ArticuloController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="./asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="./asset/css/plugins/alertify.min.css"/>
  <link rel="stylesheet" type="text/css" href="./asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="./asset/css/plugins/datatables.bootstrap.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="./asset/img/logo.png">
</head>

<body id="mimin" class="dashboard">
 <!-- start: Header -->
 <nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
        <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>
            <a href="index.html" class="navbar-brand"> 
                <b>PHP</b>
            </a>

            <ul class="nav navbar-nav search-nav">
            <li>
                <div class="search">
                    <div class="form-group form-animate-text">
                        <span class="bar"></span>
                        <label class="label-search">Prueba de <b>Desarrollo</b> </label>
                    </div>
                </div>
            </li>
            </ul>

            <ul class="nav navbar-nav navbar-right user-nav">
            <li class="user-name"><span><?php echo $_SESSION['idUsuario'] ?> </span></li>
                <li class="dropdown avatar-dropdown">
                    <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                    <ul class="dropdown-menu user-dropdown">
                        <li><a href="Controlador/LoginController.php?action=Close"><span class="fa fa-user"></span>Cerrar Sesión</a></li>
                        <li role="separator" class="divider">
                </li>
                </ul>
            </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end: Header -->