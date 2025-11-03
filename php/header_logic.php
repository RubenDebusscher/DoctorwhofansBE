<?php
  require_once __DIR__ . "/../vendor/autoload.php";
  use Dotenv\Dotenv;
  $dotenv = Dotenv::createImmutable(__DIR__ . "/..");
  $dotenv->load();
  $domain = $_ENV['APP_DOMAIN'];
  $short_domain = $_ENV['SHORT_DOMAIN'];
  $environment = $_ENV['APP_ENV'];

  
  if(isset($_GET['menu'])){
      $menu=htmlentities($_GET['menu'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
  }else if ($_SESSION["Menu"] !==""){
      $menu=$_SESSION["Menu"];
  }else{
      $menu= "Home";
  }
  if(isset($_GET['id'])){
      $id= htmlentities($_GET['id'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
  }else{$id=0;}
  
    ?>