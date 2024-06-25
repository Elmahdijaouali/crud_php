<?php
  try{
   $dbname="database_efm_php";
   $host ="localhost" ;
   $user="root" ;
   $password="" ;
   $con=new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

  }catch (PDOException $e){
    die('Erreur !!'.$e->getMessage()) ;
  }
?>