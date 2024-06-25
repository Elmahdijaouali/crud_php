<?php 
    session_start() ;
    if(!empty($_SESSION['idgroup'])){ 
        include 'init.php' ;  
        include $includes.'header.php' ;
        require_once $includes.'conxDB.php' ;

        // count les employes
       $sql_one="SELECT `codeEmp` FROM `employe` ";
       $req_one=$con->prepare($sql_one);
       $req_one->execute();
       $res_one=$req_one->fetchAll(PDO::FETCH_ASSOC);
       // count les voyages
       $sql_two="SELECT `codeVoyage` FROM `voyage` ";
       $req_two=$con->prepare($sql_two);
       $req_two->execute();
       $res_two=$req_two->fetchAll(PDO::FETCH_ASSOC);
        // count transport
        $sql_three="SELECT `codeTrans` FROM `transport` ";
        $req_three=$con->prepare($sql_three);
        $req_three->execute();
        $res_three=$req_three->fetchAll(PDO::FETCH_ASSOC);
         // recherche dans tableau d'employe 
         if(isset($_POST['username-search']) && isset($_POST['btn-search-u']) && $_POST['username-search'] != ""){
              $user=$_POST['username-search'];
              $sql="SELECT `codeEmp`, `nom`, `fonction`, `user`, `idgroup`,photo_profile FROM `employe` WHERE `user`=?";
              $req=$con->prepare($sql);
              $req->execute([$user]);
              $res=$req->fetchAll(PDO::FETCH_ASSOC);
         }else{
             // affiche tableau d'employe
              $sql="SELECT `codeEmp`, `nom`, `fonction`, `user`, `idgroup`,photo_profile FROM `employe` ";
              $req=$con->prepare($sql);
              $req->execute();
              $res=$req->fetchAll(PDO::FETCH_ASSOC);     
         }
        ?>
        <div class="container-fluid p-0" style="position: relative;height:100vh;">
            <?php
             require_once $includes.'navbar_admin.php' ;
             include $includes.'dashbord.php' ; 
             ?>
           <div class="container container_index py-5 col-10 col-md-9 col-lg-8 "  >
                <div class="row px-2">
                    <div class="col-11 col-md-5 col-lg-3 card card-ind" >
                        Number Des Employes <br> <span><?=  count($res_one) ?></span>
                    </div>
                    <div class="col-11 col-md-5 col-lg-3 card card-ind">
                        Number Des Voyages <br> <span><?=  count($res_two) ?></span>
                    </div>
                    <div class="col-11 col-md-5 col-lg-3 card card-ind">
                         Number De Transport <br> <span><?=  count($res_three) ?> </span>
                    </div>
                </div>    
                <h1  class="mt-5">les employes </h1>
                <form action="" class="col-12" method="post" > 
                    <input type="text" name="username-search" placeholder="recherche sur l'employe by user name" class="form-control "><br> 
                    <input type="submit" name="btn-search-u" value="search" class="btn form-control " style="background:#4D869C;color:white;"> 
                </form> <br>
          <div class="container-table-index">
                
                <table class="table table-responsive " >
                  <thead>
                        <tr>  
                            <th>Code Employe</th>
                            <th>Nom Employe</th>
                            <th>Fonction De Employe</th>
                            <th>User Name </th>
                            <th>Id Group</th>
                            <th>photo profile</th>
                            <th>Action</th>                           
                       </tr>
                  </thead>
                  <tbody>
                    <?php 
                     foreach($res as $emp){
                      ?>
                      <tr>
                          <td><?= $emp['codeEmp'] ?></td>
                          <td><?= $emp['nom'] ?></td>
                          <td><?= $emp['fonction'] ?></td>
                          <td><?= $emp['user'] ?></td>
                          <td><?php if($emp['idgroup']==1){ echo "Admin" ;}else{echo "Employe" ;} ?></td>
                          <td>  <img width="100px" height="50px" src="../upload_images/<?php if(empty($emp['photo_profile'] )){ echo "defult_photo_profile.jpg"; }else{ echo $emp['photo_profile'] ;} ?>" alt=""></td>
                          <td>
                              <a href="profile.php?codeEmp= <?= $emp['codeEmp'] ?> " class="btn_style btn">Afficher</a>
                              <a href="modifer_Emp.php?codeEmp= <?= $emp['codeEmp'] ?> " class="btn-success btn">Modifer</a>
                              <a href="supprimer_Emp.php?codeEmp= <?= $emp['codeEmp'] ?> " class=" btn btn-danger">Supprimer</a>
                          </td>
                      </tr>
                      <?php
                    }
                    ?> 
                  </tbody>
                </table>
                </div>
                <hr>
           </div>     
        </div>
           <!-- <script src="script_admin_index.js"></script> -->
         <?php
        include $includes.'footer.php' ;
    }else{
      header("location:../pages/connEmp.php") ;
    }
   ?>