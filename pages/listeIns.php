      <?php
      session_start() ;
      if(!empty($_SESSION['user'])){
      require_once 'init.php' ;
         require_once $includes.'conxDB.php' ;

        $sql =" SELECT 
        inscription.codeInsc , inscription.codeEmp , 
        inscription.codeVoyage , inscription.nbrePers , 
        inscription.dateVoy ,employe.codeEmp,
        voyage.codeVoyage,voyage.prixTicket
       FROM  inscription 
        JOIN employe  
       ON inscription.codeEmp=employe.codeEmp
       JOIN voyage 
       ON voyage.codeVoyage=inscription.codeVoyage 
       ORDER BY codeInsc ";

        $req=$con->prepare($sql) ;
        $req->execute();
        $res=$req->fetchAll(PDO::FETCH_ASSOC) ;
        // include header 
         include $includes.'header.php' ;
         // include menu
         require_once $includes.'navbar.php' ;
      ?>
     <div class="container py-5">
          <h1 style="text-align: center;"> les inscriptions  </h1>
        <table class="table mt-5  col-12 " >
          <thead class="thead">
            <tr>
                <th>code d'inscription </th>
                <th>date de Voyage </th>
                <th>nombre de Personnes inscrit</th>
                <th>total à payer </th>
                <th>Afficher les information </th>
            </tr>
          </thead>
          <tbody class="tbody ">
            <?php 
            foreach($res as $ins){
              ?>
               <tr>
                  <td><?= $ins['codeInsc'] ?></td>
                  <td><?= $ins['dateVoy'] ?></td>
                  <td><?= $ins['nbrePers'] ?></td>
                  <td><?= $ins['nbrePers'] * $ins['prixTicket']  ?></td>
                  <td><a href="afficher_inf.php?codeInsc=<?= $ins['codeInsc'] ;?>" class="btn_style btn">Afficher</a></td>
               </tr>
              <?php
             }
            ?>
          </tbody>
        </table>
    </div>
    <?php
    // include footer
        include $includes.'footer.php' ;
            }else{
              header("location:connEmp.php") ;
            }
     ?>