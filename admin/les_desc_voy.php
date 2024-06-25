<?php 
    session_start() ;
    if(!empty($_SESSION['idgroup'])){       
        include 'init.php' ;      
       
        include $includes.'header.php' ;
        require_once $includes.'conxDB.php' ;
         // recherche dans tableau voyage
         if(isset($_POST['description-search']) && isset($_POST['btn-search-description']) && $_POST['description-search'] != ""){
              $description=$_POST['description-search'];
              $sql="SELECT `codeDesc`, `description`, `villeD`, `villeA` FROM `description_voyage` WHERE  description=?";
              $req=$con->prepare($sql);
              $req->execute([$description]);
              $res=$req->fetchAll(PDO::FETCH_ASSOC);  
         }else{
             // affiche tableau transport
              $sql="SELECT `codeDesc`, `description`, `villeD`, `villeA` FROM `description_voyage` ";
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
                <h1  class="mt-5">les descriptions de voyage </h1>
                <form action="" class="col-12" method="post" > 
                    <input type="text" name="description-search" placeholder="recherche sur description de voyage " class="form-control "><br> 
                    <input type="submit" name="btn-search-description" value="search" class="btn form-control " style="background:#4D869C;color:white;"> 
                </form> <br>
                <div class="container-table-index">
                <table class="table ">
                  <thead>
                        <tr>  
                            <th>Code description voyage</th>
                            <th>description</th>
                            <th>ville de départ</th>
                            <th>ville d'arrivé</th>
                            
                            <th>Action</th>                           
                       </tr>
                  </thead>
                  <tbody>
                    <?php 
                     foreach($res as $desc){
                      ?>
                      <tr>
                          <td><?= $desc['codeDesc'] ?></td>
                          <td><?= $desc['description'] ?></td>
                          <td><?= $desc['villeD'] ?></td>
                          <td><?= $desc['villeA'] ?> </td>
                          <td>
                              <a href="modifer_desc_voy.php?codeDesc= <?= $desc['codeDesc'] ?>" class="btn-success btn">Modifer</a>
                              <a href="supprimer_desc_voy.php?codeDesc= <?= $desc['codeDesc'] ?>" class=" btn btn-danger">Supprimer</a>
                          </td>
                      </tr>
                      <?php }?>
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