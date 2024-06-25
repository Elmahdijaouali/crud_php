<?php           
                session_start();
                if(!empty($_SESSION['idgroup'])){
                       include 'init.php' ;
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;  
                  $codeDesc=$_GET['codeDesc'];
                  if(isset($_POST['villeD']) && isset($_POST['villeA']) && isset($_POST['description']) ){
                         $description=$_POST['description'] ;
                         $villeD=$_POST['villeD'] ;
                         $villeA=$_POST['villeA'] ;
                         // modifer description  
                         $sql="UPDATE `description_voyage` SET `description`=?,`villeD`=?,`villeA`=? WHERE codeDesc=?";
                         $req=$con->prepare($sql);
                         $req->execute([ $description , $villeD , $villeA , $codeDesc]); 
                         header("location:les_desc_voy.php");
                      } 
                      $sql="SELECT `codeDesc`, `description`, `villeD`, `villeA` FROM `description_voyage` WHERE codeDesc=?";
                      $req=$con->prepare($sql);
                      $req->execute([ $codeDesc]);
                      $res=$req->fetch(PDO::FETCH_ASSOC);              
                      ?>
       <div class="container-fluid p-0" style="position: relative;height:100vh;">
           <?php
            require_once $includes.'navbar_admin.php' ;
            include $includes.'dashbord.php' ; 
            ?>        
          <div class="container container-sinscrire ">
            <form action="" method="post" class="col-12 col-md-8  col-lg-6 p-5 form-sinscrire" >
              <h1 style="text-align: center;">Modifer description de voyage</h1>
                    description: <br>
                    <input type="text"  name="description" class="form-control" value="<?= $res['description'] ?>"> <br>
                    ville de départ : <br>
                    <input type="text" name="villeD" class="form-control" value="<?= $res['villeD'] ?>"> <br>
                    ville d'arrivée  : <br>
                    <input type="text" name="villeA" class="form-control" value="<?= $res['villeA'] ?>"> <br>
                    <input type="submit" name="modifer" value="Modifer " class="btn_style btn form-control "> <br>
           </form>    
        </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:../pages/connEmp.php") ;
         }
?>