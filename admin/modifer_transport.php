<?php           
                session_start();
                if(!empty($_SESSION['idgroup'])){
                      include 'init.php' ;
                     
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;  
                   $codeTrans=$_GET['codeTrans'];
                  if(isset($_POST['type']) && isset($_POST['vitesse']) && isset($_POST['nbrPlace'])){
                         $type=$_POST['type'] ;
                         $vitesse=$_POST['vitesse'] ;
                         $nbrPlace=$_POST['nbrPlace'] ;
                         // modifer transport
                         $sql="UPDATE `transport` SET `type`=?,`vitesse`=?,`nbrPlace`=? WHERE codeTrans=?";
                         $req=$con->prepare($sql);
                         $req->execute([ $type , $vitesse , $nbrPlace,$codeTrans ]);  
                         header("location:les_transports.php");
                      }
                      $sql_two="SELECT `codeTrans`, `type`, `vitesse`, `nbrPlace` FROM `transport` WHERE  codeTrans=?";
                      $req_two=$con->prepare($sql_two);
                      $req_two->execute([ $codeTrans]);
                      $res=$req_two->fetch(PDO::FETCH_ASSOC);
                      ?>
         <div class="container-fluid p-0" style="position: relative;height:100vh;">
           <?php
            require_once $includes.'navbar_admin.php' ;
            include $includes.'dashbord.php' ; 
            ?>
         <div class="container container-sinscrire ">   
          <form action="" method="post" class="col-12 col-md-8  col-lg-6 p-5 form-sinscrire" >
              <h1 style="text-align: center;">insert transport  </h1>
                    type: <br>
                    <input type="text"  name="type" class="form-control" value="<?= $res['type'] ?>"> <br>
                    vitesse: <br>
                    <input type="numbdr" name="vitesse" class="form-control" value="<?= $res['vitesse'] ?>"> <br>
                    nbrPlace : <br>
                    <input type="number" name="nbrPlace" class="form-control" value="<?= $res['nbrPlace'] ?>"> <br>
                    <input type="submit" name="modifer" value="Modifer " class="btn_style btn form-control "> <br>
           </form>    
      </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:../pages/connEmp.php") ;
         }
?>