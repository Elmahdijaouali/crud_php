<?php           
                session_start();
                if(!empty($_SESSION['idgroup'])){
                      include 'init.php' ;
                        
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;
                     $pageTitle="Insert employe";
                  if(isset($_POST['nom']) && isset($_POST['gender']) && isset($_POST['idgroup']) && isset($_POST['fonction']) && isset($_POST['user'])   && isset($_POST['pwd']) ){
                     echo $_POST['nom'] ;
                         $nom=$_POST['nom'] ;
                         $gender=$_POST['gender'] ;
                         $idgroup=$_POST['idgroup'] ;
                         $fonction=$_POST['fonction'] ;
                         $user=$_POST['user'] ;
                         $img_profile=$_FILES['img_profile']['name'];
                         $pwd=sha1($_POST['pwd'] );
                        //  deplace image 
                           move_uploaded_file($_FILES['img_profile']['tmp_name'],"../upload_images/".$img_profile);
                         // insert dans le tableau employe
                         $sql="INSERT INTO `employe`(`nom`, `fonction`, `user`, `pwd`, `idgroup`, `gender`, `photo_profile`) VALUES (?,?,?,?,?,?,?)";
                         $req=$con->prepare($sql);
                         $req->execute([ $nom , $fonction , $user ,$pwd  , $idgroup,  $gender ,   $img_profile]);
                         header("location:index.php") ; 
                      }
                      ?>
                       <div class="container-fluid p-0" style="position: relative;height:100vh;"> 
                         <?php
                          require_once $includes.'navbar_admin.php' ;
                          include $includes.'dashbord.php' ; 
                          ?>
         <div class="container  container-sinscrire pb-5">     
          <form action="insert_emp.php" method="post" class="col-12 col-md-8  p-5  form-sinscrire" enctype="multipart/form-data">
              <h1 style="text-align: center;">insert employe </h1>
                     nom de employe <span style="color: red;">*</span> : <br>
                    <input type="text"  name="nom" class="form-control"> <br>
                    <div class="row">
                         <div class="col-6">
                         gender <span style="color: red;">*</span> : <br>
                              <table class="ms-5">
                               <tr>
                                  <td>Homme</td>
                                  <td class="ps-3"> <input type="radio" value="homme"  name="gender"></td>
                               </tr>
                               <tr>
                                  <td>Femme</td>
                                  <td class="ps-3"><input type="radio" value="femme" name="gender"></td>
                               </tr>
                              </table> <br>
                         </div>
                         <div class="col-6">
                         type <span style="color: red;">*</span> :
                           <table class="ms-5">
                            <tr>
                               <td>Employe</td>
                               <td class="ps-3"> <input type="radio" value="0"  name="idgroup"></td>
                            </tr>
                            <tr>
                               <td>Admin</td>
                               <td class="ps-3"><input type="radio" value="1" name="idgroup"></td>
                            </tr>
                           </table> <br>
                         </div>
                    </div>
                    fonction de employe <span style="color: red;">*</span> : <br>
                    <input type="text" name="fonction" class="form-control"> <br>
                    user name <span style="color: red;">*</span> : <br>
                    <input type="text" name="user" class="form-control"> <br>
                    photo profile <span style="color: red;">*</span> : <br>
                    <label for="img_profile" class="label_upload" ><i class="fa fa-upload " ></i> Upload image</label><br> <br>
                    <input type="file" name="img_profile" id="img_profile">

                    password <span style="color: red;">*</span> : <br>
                    <input type="text" name="pwd" class="form-control"> <br>
                    <input type="submit" name="insertion" value="insertion " class="btn_style btn form-control "> <br>
           </form>    
      </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:../pages/connEmp.php") ;
         }
?>