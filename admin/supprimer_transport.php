<?php
  session_start() ;
  if(!empty($_SESSION['idgroup'])){ 
    include 'init.php';
    include  $func.'function.php';
    require_once $includes.'conxDB.php';
    $codeTrans=$_GET['codeTrans'];
    $sql="DELETE FROM transport WHERE codeTrans=?";
    $req=$con->prepare($sql);
    $req->execute([ $codeTrans ]) ;
    header("location:les_transports.php");
  }else{
    header("location:../pages/connEmp.php") ;
  }
?>