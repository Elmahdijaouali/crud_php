<?php 
    session_start() ;
    if(!empty($_SESSION['idgroup'])){   
        include 'init.php' ;   
       
        include $includes.'header.php' ;
        require_once $includes.'conxDB.php' ;
      
         // recherche dans tableau d'employe 
         if(isset($_POST['nomEmp-search']) && isset($_POST['btn-search-inscription']) && $_POST['nomEmp-search'] != ""){
              $nomEmp=$_POST['nomEmp-search'];
              $sql="SELECT `codeInsc`, inscription.codeEmp, employe.codeEmp ,employe.nom, `codeVoyage`, `nbrePers`, `dateVoy` FROM `inscription` INNER JOIN employe ON employe.codeEmp=inscription.codeEmp WHERE employe.nom=? ";
              $req=$con->prepare($sql);
              $req->execute([$nomEmp]);
              $res=$req->fetchAll(PDO::FETCH_ASSOC);
             
         }else{
             // affiche tableau d'inscription
              $sql="SELECT `codeInsc`, inscription.codeEmp, employe.codeEmp ,employe.nom, `codeVoyage`, `nbrePers`, `dateVoy` FROM `inscription` INNER JOIN employe ON employe.codeEmp=inscription.codeEmp ";
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
                <h1  class="mt-5">les s'inscrire  </h1>
                <form action="" class="col-12" method="post" > 
                    <input type="text" name="nomEmp-search" placeholder="recherche sur nom de employe " class="form-control "><br> 
                    <input type="submit" name="btn-search-inscription" value="search" class="btn form-control " style="background:#4D869C;color:white;"> 
                </form> <br>
                <div class="container-table-index">
                <table class="table ">
                  <thead>
                        <tr>  
                            <th>Code Inscription</th>
                            <th>Nom Employe</th>
                            <th>code de voyage</th>
                            <th>number de personnes </th>
                            <th>date de voyage </th>
                            <th>Action</th>                           
                       </tr>
                  </thead>
                  <tbody>
                    <?php 
                     foreach($res as $emp){
                      ?>
                      <tr>
                          <td><?= $emp['codeInsc'] ?></td>
                          <td><?= $emp['nom'] ?></td>
                          <td><?= $emp['codeVoyage'] ?></td>
                          <td><?= $emp['nbrePers'] ?></td>
                          <td><?= $emp['dateVoy'] ?></td>
                          <td>
                              <a href="supprimer_inscription.php?codeEmp= <?= $emp['codeEmp'] ?> " class=" btn btn-danger">Supprimer</a>
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