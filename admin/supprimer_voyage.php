<?php
  session_start() ;
  if(!empty($_SESSION['idgroup'])){ 
    include 'init.php';
    include  $func.'function.php';
    require_once $includes.'conxDB.php';
    $codeVoyage=$_GET['codeVoyage'];

    $sql="DELETE FROM inscription WHERE codeVoyage=?";
    $req=$con->prepare($sql);
    $req->execute([ $codeVoyage ]) ; 

    $sql="DELETE FROM voyage WHERE codeVoyage=?";
    $req=$con->prepare($sql);
    $req->execute([ $codeVoyage ]) ;

    header("location:les_voyages.php");

  }else{
    header("location:../pages/connEmp.php") ;
  }
?>