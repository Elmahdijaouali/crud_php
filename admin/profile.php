<?php  
                session_start();
                if(!empty($_SESSION['idgroup'])){
                    include 'init.php' ;
                    //  include conction database
                    require_once $includes.'conxDB.php';
                    //  include header
                    include $includes.'header.php' ;
                    
                     $codeEmp= $_GET['codeEmp'];
                     $sql="SELECT `codeEmp`, `nom`, `fonction`, `user`, `pwd`, `idgroup`, `gender`, `photo_profile`, `date_creation` FROM `employe` WHERE codeEmp=?";
                     $req=$con->prepare($sql);
                     $req->execute([$codeEmp]);
                     $res=$req->fetch(PDO::FETCH_ASSOC);
                    if( $res['idgroup'] == 1){ 
                         $type = "<span class='span_type ms-3'>Admin</span>" ;
                     }else{ 
                        $type = "<span class='span_type ms-3' >Employe</span>" ;
                     }

?>
         <div class="container-fluid p-0" style="position: relative;height:100vh;">                        
                         <?php
                          require_once $includes.'navbar_admin.php' ;
                          include $includes.'dashbord.php' ; 
                          ?>
        <div class="container py-5 ">
            <div class="row row_img_profil ps-4">
                     <div>
                           <img src="../upload_images/<?php if(empty($res['photo_profile']  )){ echo "defult_photo_profile.jpg"; }else{ echo $res['photo_profile']  ;} ?>" class="img_profile "   alt="" >
                     </div>    
            </div>
            <div class="row row_info ps-3" >
                <div class="col-12 col-lg-6">
                   <h3 class="ps-3"> <?= $res['user'] ." ". $type ?> </h3>        
                   <hr>
                   <ul class="info_profile">
                       <li>Nom :<?= $res['nom'] ?> </li>
                       <li>Sexe :<?= $res['gender'] ?> </li>
                       <li>Fonction :<?= $res['fonction'] ?> </li>
                       <li>Date de creation :<?= $res['date_creation'] ?> </li>
                   </ul>
                </div>
                <hr>
                <hr>
            </div>
        </div>
<?php
                     include $includes.'footer.php' ;
                    }else{
                       header("location:../pages/connEmp.php") ;
                    }                  
?>