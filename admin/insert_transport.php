<?php           
                session_start();
                if(!empty($_SESSION['idgroup'])){
                      include 'init.php' ;
                     
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;
                
                  if(isset($_POST['type']) && isset($_POST['vitesse']) && isset($_POST['nbrPlace'])){
                         $type=$_POST['type'] ;
                         $vitesse=$_POST['vitesse'] ;
                         $nbrPlace=$_POST['nbrPlace'] ;
                         // insert dans le tableau transport
                         $sql="INSERT INTO `transport`( `type`, `vitesse`, `nbrPlace`) VALUES  (?,?,?)";
                         $req=$con->prepare($sql);
                         $req->execute([ $type , $vitesse , $nbrPlace ]);   
                      }
                      ?>
         <div class="container-fluid p-0" style="position: relative;height:100vh;">           
           <?php
            require_once $includes.'navbar_admin.php' ;
            include $includes.'dashbord.php' ; 
            ?>
         <div class="container container-sinscrire ">          
          <form action="insert_transport.php" method="post" class="col-12 col-md-8  col-lg-6 p-5 form-sinscrire" >
              <h1 style="text-align: center;">insert transport  </h1>
                    type: <br>
                    <input type="text"  name="type" class="form-control"> <br>
                    vitesse: <br>
                    <input type="numbdr" name="vitesse" class="form-control"> <br>
                    nbrPlace : <br>
                    <input type="number" name="nbrPlace" class="form-control"> <br>
                    <input type="submit" name="insertion" value="insertion " class="btn_style btn form-control "> <br>
           </form>    
      </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:../pages/connEmp.php") ;
         }
?>