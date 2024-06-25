<?php
  session_start() ;
  if(!empty($_SESSION['idgroup'])){
    include 'init.php';
    include  $func.'function.php';
    require_once $includes.'conxDB.php';
    $codeDesc=$_GET['codeDesc'];
    $sql="DELETE FROM description_voyage WHERE codeDesc=?";
    $req=$con->prepare($sql);
    $req->execute([ $codeDesc ]) ;
    header("location:les_desc_voy.php");
  }else{
    header("location:../pages/connEmp.php") ;
  }
?>