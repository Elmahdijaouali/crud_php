<?php           
                session_start();
                if(!empty($_SESSION['idgroup'])){
                      include 'init.php' ;
                      
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;
                     $codeEmp=$_GET['codeEmp'] ;
                  if(isset($_POST['nom']) && isset($_POST['gender']) && isset($_POST['idgroup']) && isset($_POST['fonction']) && isset($_POST['user']) ){
                         $nom=$_POST['nom'] ;
                         $gender=$_POST['gender'] ;
                         $idgroup=$_POST['idgroup'] ;
                         $fonction=$_POST['fonction'] ;
                         $user=$_POST['user'] ;
                         // modifer employe
                         $sql="UPDATE `employe` SET `nom`=? , `fonction`=? , `user`=? , `idgroup`=? , `gender`=?  WHERE codeEmp=? ";
                         $req=$con->prepare($sql);
                         $req->execute([ $nom , $fonction , $user  , $idgroup,  $gender , $codeEmp ]);
                         header("location:index.php") ;     
                      }
                     //   remplir les inputs 
                         $sql="SELECT  `nom`, `fonction` , `user` , `idgroup` , `gender` FROM `employe` WHERE codeEmp=? ";
                         $req=$con->prepare($sql);
                         $req->execute([$codeEmp]);
                         $res=$req->fetch(PDO::FETCH_ASSOC);
                      ?>
          <div class="container-fluid p-0" style="position: relative;height:100vh;">          
                         <?php
                          require_once $includes.'navbar_admin.php' ;
                          include $includes.'dashbord.php' ; 
                          ?>
         <div class="container  container-sinscrire pb-5">  
          <form action="" method="post" class="col-12 col-md-8  p-5  form-sinscrire" enctype="multipart/form-data">
              <h1 style="text-align: center;">Modifer employe </h1>
                     nom de employe <span style="color: red;">*</span> : <br>
                    <input type="text"  name="nom" class="form-control" value="<?= $res['nom'] ?>"> <br>
                    <div class="row">
                         <div class="col-6">
                         gender <span style="color: red;">*</span> : <br>
                              <table class="ms-5">
                               <tr>
                                  <td>Homme</td>
                                  <td class="ps-3"> <input type="radio" value="homme"  name="gender" ></td>
                               </tr>
                               <tr>
                                  <td>Femme</td>
                                  <td class="ps-3"><input type="radio" value="femme" name="gender" ></td>
                               </tr>
                              </table> <br>
                         </div>
                         <div class="col-6">
                         type <span style="color: red;">*</span> :
                           <table class="ms-5">
                            <tr>
                               <td>Employe</td>
                               <td class="ps-3"> <input type="radio" value="0"  name="idgroup" ></td>
                            </tr>
                            <tr>
                               <td>Admin</td>
                               <td class="ps-3"><input type="radio" value="1" name="idgroup" ></td>
                            </tr>
                           </table> <br>
                         </div>
                    </div>
                    fonction de employe <span style="color: red;">*</span> : <br>
                    <input type="text" name="fonction" class="form-control" value="<?= $res['fonction'] ?>"> <br>
                    user name <span style="color: red;">*</span> : <br>
                    <input type="text" name="user" class="form-control" value="<?= $res['user'] ?>"> <br>
                    <input type="submit" name="modifer" value="Modifer " class="btn_style btn form-control "> <br>
           </form>    
      </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:../pages/connEmp.php") ;
         }
?>