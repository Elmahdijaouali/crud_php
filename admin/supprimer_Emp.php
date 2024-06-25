<?php
  session_start() ;
  if(!empty($_SESSION['idgroup'])){
    include 'init.php';
    include  $func.'function.php';
    require_once $includes.'conxDB.php';
    $pageTitle="Supprimer employe";
    $codeEmp=$_GET['codeEmp'];
    $sql="DELETE FROM inscription WHERE codeEmp=?";
    $req=$con->prepare($sql);
    $req->execute([ $codeEmp ]) ;
    $sql="DELETE FROM employe WHERE codeEmp=?";
    $req=$con->prepare($sql);
    $req->execute([ $codeEmp ]) ;
    header("location:index.php");
  }else{
    header("location:../pages/connEmp.php") ;
  }

?>