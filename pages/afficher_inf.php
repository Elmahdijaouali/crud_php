<?php
  session_start();
  if(!empty($_SESSION['user'])){
  include 'init.php' ;
  require_once $includes.'conxDB.php' ;
  $codeInsc =$_GET['codeInsc'] ;
  $sql ="SELECT  codeInsc , inscription.codeInsc , inscription.dateVoy ,
   voyage.codeDesc ,  description_voyage.codeDesc , description_voyage.villeD ,
    description_voyage.villeA ,heureDepart  ,  duree
   FROM voyage 
   INNER JOIN description_voyage 
   ON voyage.codeDesc = description_voyage.codeDesc 
   INNER JOIN inscription
   ON inscription.codeInsc= codeInsc
   WHERE codeInsc =$codeInsc
   ";
   $req=$con->prepare($sql) ;
   $req->execute() ;
   $res= $req->fetch(PDO::FETCH_ASSOC) ; 
?>
<!-- include header et menu  -->
<?php
 include $includes."header.php";
 include $includes."navbar.php";
?>
   <div class="container p-5">
      <h1 style="text-align: center;">les informations de voyage  </h1>
       <ul class="info_profile mt-5">   
          <li >date de voyage  : <?= $res['dateVoy'] ?> </li>
          <li >ville de départ :  <?= $res['villeD'] ?> </li>
          <li >ville d'arrivée : <?= $res['villeA'] ?> </li>
          <li >heure de départ : <?= $res['heureDepart'] ?> </li>
          <li >heure d'arrivée : <?=  $res['duree']  ?></li>   
       </ul>
   </div>
<!-- include footer  -->
 <?php 
  include $includes.'footer.php' ;
 }else {
    header("location:connEmp.php") ;
 }
 ?>
