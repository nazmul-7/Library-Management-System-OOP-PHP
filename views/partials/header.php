<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/includes/css/bootstrap.min.css">
    <link href="<?php echo BASE_URL; ?>/includes/css/offcanvas.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.0/css/mdb.min.css" rel="stylesheet">
     <!-- JQuery -->
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>/includes/css/main.css" />
    
</head>
<body>

<?php
    session::start();
    $nav='navber';
    if(session::get("login") == true){
        if(session::get("userType")== 1){
             $nav ='adminNavber';
           
        }
      
    }
   
?>

<?php  include_once('views/partials/'.$nav.'.php'); ?>
