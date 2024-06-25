      <?php           
                session_start();
                if(!empty($_SESSION['user'])){
                include 'init.php' ;
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;
                     //  include menu 
                      include $includes.'navbar.php' ;
                     //  requet pour obtenir ville départ et ville d'arrivée pour que je l'utilise dans les selects dans html 
                        $sql="SELECT villeD,villeA FROM description_voyage ";
                        $req=$con->prepare($sql);
                        $req->execute();
                        $res =$req->fetchAll(PDO::FETCH_ASSOC);
                  if(isset($_POST['villeD']) && isset($_POST['villeA']) && isset($_POST['dateVoy']) && isset($_POST['nberPers'])){
                         $villeD=$_POST['villeD'] ;
                         $villeA=$_POST['villeA'] ;
                         $dateVoy=$_POST['dateVoy'] ;
                         $nberPers=$_POST['nberPers'] ;
                         // requit pour obtenir code Voyage 
                         $sql_one ="SELECT description_voyage.codeDesc ,voyage.codeDesc,voyage.codeVoyage
                          FROM description_voyage
                         INNER JOIN voyage 
                         ON  voyage.codeDesc=description_voyage.codeDesc   
                         WHERE villeD=? AND villeA=? " ;
                         $req_one=$con->prepare($sql_one);
                         $req_one->execute([$villeD , $villeA ]);
                         $res_one=$req_one->fetch(PDO::FETCH_ASSOC);

                         $codeVoy= $res_one['codeVoyage']  ;

                         // utliser session pour obtenir code Employe 
                         $codeEmp=$_SESSION['codeEmp'];
                         // requit insert dans tableau inscrition 
                         $sql_three ="INSERT INTO `inscription`( `codeEmp`, `codeVoyage`, `nbrePers`, `dateVoy`)
                          VALUES (?,?,?,?) " ;
                         $req_three =$con->prepare($sql_three) ;
                         $req_three->execute([$codeEmp,   $codeVoy ,  $nberPers ,$dateVoy]);
                      }
                      ?>
         <div class="container container-sinscrire ">
          <form action="sinscrire.php" method="post" class="col-12 col-md-8  col-lg-6 p-5 form-sinscrire" >
              <h1 style="text-align: center;">S'inscrire  </h1>
                    Ville  départ  : <br>
                    <select name="villeD" class="form-control">
                    <!-- rempli ville départ -->
                    <?php 
                     foreach ($res as $val) {
                        ?>
                        <option value="<?= $val['villeD'] ?>"><?= $val['villeD'] ?></option>
                        <?php
                     }
                    ?>
                   </select> <br>
                   Ville d'arrivé : <br>
                   <select name="villeA" class="form-control">
                   <!-- rempli ville d'arrivé -->
                    <?php 
                         foreach ($res as $val) {
                            ?>
                            <option value="<?= $val['villeA'] ?>"><?= $val['villeA'] ?></option>
                            <?php
                         }
                    ?>
                </select> <br>
                 date de voyage  : <br>
                 <input type="date" name="dateVoy" class="form-control"> <br>
                 nomber de personnes : <br>
                 <input type="text" name="nberPers" class="form-control"> <br>
                 <input type="submit" name="sinscrire" value="S'inscrire" class="btn_style btn form-control "> <br>
           </form>    
      </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:connEmp.php") ;
         }
      ?>