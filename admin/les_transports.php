<?php 
    session_start() ;
    if(!empty($_SESSION['idgroup'])){       
        include 'init.php' ;      
        include $includes.'header.php' ;
        require_once $includes.'conxDB.php' ;
         // recherche dans tableau voyage
         if(isset($_POST['type-search']) && isset($_POST['btn-search-transport']) && $_POST['type-search'] != ""){
              $type=$_POST['type-search'];
              $sql="SELECT `codeTrans`, `type`, `vitesse`, `nbrPlace` FROM `transport` WHERE type=? ";
              $req=$con->prepare($sql);
              $req->execute([$type]);
              $res=$req->fetchAll(PDO::FETCH_ASSOC);
             
         }else{
             // affiche tableau transport
              $sql="SELECT `codeTrans`, `type`, `vitesse`, `nbrPlace` FROM `transport` ";
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
                <h1  class="mt-5">les transports </h1>
                <form action="" class="col-12" method="post" > 
                    <input type="text" name="type-search" placeholder="recherche sur transport by type transport " class="form-control "><br> 
                    <input type="submit" name="btn-search-transport" value="search" class="btn form-control " style="background:#4D869C;color:white;"> 
                </form> <br>
                <div class="container-table-index">
                <table class="table ">
                  <thead>
                        <tr>  
                            <th>Code transport</th>
                            <th>type</th>
                            <th>vitesse</th>
                            <th>nombre de place</th>
                            
                            <th>Action</th>                           
                       </tr>
                  </thead>
                  <tbody>
                    <?php 
                     foreach($res as $trans){
                      ?>
                      <tr>
                          <td><?= $trans['codeTrans'] ?></td>
                          <td><?= $trans['type'] ?></td>
                          <td><?= $trans['vitesse'] ?></td>
                          <td><?= $trans['nbrPlace'] ?> </td> 
                          <td>
                              <a href="modifer_transport.php?codeTrans= <?= $trans['codeTrans'] ?> " class="btn-success btn">Modifer</a>
                              <a href="supprimer_transport.php?codeTrans= <?= $trans['codeTrans'] ?>" class=" btn btn-danger">Supprimer</a>
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