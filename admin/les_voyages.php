<?php 
    session_start() ;
    if(!empty($_SESSION['idgroup'])){       
        include 'init.php' ;      
        include $includes.'header.php' ;
        require_once $includes.'conxDB.php' ;
         // recherche dans tableau voyage
         if(isset($_POST['description-search']) && isset($_POST['btn-search-voyage']) && $_POST['description-search'] != ""){
              $description=$_POST['description-search'];
              $sql="SELECT `codeVoyage`, voyage.codeTrans,transport.codeTrans,transport.type,voyage.codeDesc,description_voyage.codeDesc, description_voyage.description, `prixTicket`, `duree`, `heureDepart` FROM `voyage` INNER JOIN transport ON transport.codeTrans =  voyage.codeTrans INNER JOIN description_voyage ON voyage.codeDesc=description_voyage.codeDesc WHERE description_voyage.description=? ";
              $req=$con->prepare($sql);
              $req->execute([$description]);
              $res=$req->fetchAll(PDO::FETCH_ASSOC);
             
         }else{
             // affiche tableau voyage
              $sql="SELECT `codeVoyage`, voyage.codeTrans,transport.codeTrans,transport.type,voyage.codeDesc,description_voyage.codeDesc, description_voyage.description, `prixTicket`, `duree`, `heureDepart` FROM `voyage` INNER JOIN transport ON transport.codeTrans =  voyage.codeTrans INNER JOIN description_voyage ON voyage.codeDesc=description_voyage.codeDesc ";
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
                <h1  class="mt-5">les voyages des employes  </h1>
                <form action="" class="col-12" method="post" > 
                    <input type="text" name="description-search" placeholder="recherche sur voyage by description " class="form-control "><br> 
                    <input type="submit" name="btn-search-voyage" value="search" class="btn form-control " style="background:#4D869C;color:white;"> 
                </form> <br>
                <div class="container-table-index">
                <table class="table ">
                  <thead>
                        <tr>  
                            <th>Code voyage</th>
                            <th>transport</th>
                            <th>description</th>
                            <th>prix de ticket </th>
                            <th>durée</th>
                            <th>heure départ</th>
                            <th>Action</th>                           
                       </tr>
                  </thead>
                  <tbody>
                    <?php 
                     foreach($res as $voy){
                      ?>
                      <tr>
                          <td><?= $voy['codeVoyage'] ?></td>
                          <td><?= $voy['type'] ?></td>
                          <td><?= $voy['description'] ?></td>
                          <td><?= $voy['prixTicket'] ?> MAD</td>
                          <td><?= $voy['duree'] ?></td>
                          <td><?= $voy['heureDepart'] ?></td>
                          <td>
                          <a href="modifer_voyage.php?codeVoyage= <?= $voy['codeVoyage'] ?> " class="btn-success btn">Modifer</a>
                              <a href="supprimer_voyage.php?codeVoyage= <?= $voy['codeVoyage']  ?> " class=" btn btn-danger">Supprimer</a>
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