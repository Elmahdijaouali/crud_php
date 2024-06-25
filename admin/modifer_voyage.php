
<?php           
                session_start();
                if(!empty($_SESSION['idgroup'])){
                      include 'init.php' ;
                
                     //  include conction database
                      require_once $includes.'conxDB.php';
                     //  include header
                      include $includes.'header.php' ;
                   
                     $codeVoyage=$_GET['codeVoyage'];
                  if(isset($_POST['codeTrans']) && isset($_POST['codeDesc']) && isset($_POST['prixTicket']) && isset($_POST['duree']) && isset($_POST['heureDepart']) && $_POST['codeTrans']!="" && $_POST['codeDesc']!= "" ){
                         $codeTrans=$_POST['codeTrans'] ;
                         $codeDesc=$_POST['codeDesc'] ;
                         $prixTicket=$_POST['prixTicket'] ;
                         $duree=$_POST['duree'] ;
                         $heureDepart=$_POST['heureDepart'] ;
                         // modifer voyage
                         $sql_one="UPDATE `voyage` SET `codeTrans`=?,`codeDesc`=?,`prixTicket`=?,`duree`=?,`heureDepart`=? WHERE codeVoyage=?";
                         $req_one=$con->prepare($sql_one);
                         $req_one->execute([ $codeTrans , $codeDesc , $prixTicket ,$duree , $heureDepart ,$codeVoyage ]);
                         header("location:les_voyages.php");
                      }
                         $sql_one="SELECT `codeVoyage`, `codeTrans`, `codeDesc`, `prixTicket`, `duree`, `heureDepart` FROM `voyage` WHERE codeVoyage=? ";
                         $req_one=$con->prepare($sql_one);
                         $req_one->execute([ $codeVoyage ]);
                         $res=$req_one->fetch(PDO::FETCH_ASSOC);
                      ?>
     <div class="container-fluid p-0" style="position: relative;height:100vh;">                  
                         <?php
                          require_once $includes.'navbar_admin.php' ;
                          include $includes.'dashbord.php' ; 
                          ?>
         <div class="container container-sinscrire ">   
           <form action="" method="post" class="col-12 col-md-8  col-lg-6 p-5 form-sinscrire" >
              <h1 style="text-align: center;">Modifer voyage  </h1>
                    transport: <br>
                    <select name="codeTrans" class="form-control" >
                      <option value="">-- choise un tronsport--</option>
                           <?php
                             $sql = "SELECT codeTrans,type FROM transport ;SELECT codeDesc,description FROM description_voyage  " ;
                             $req=$con->prepare($sql);
                             $req->execute();
                             $res_one=$req->fetchAll(PDO::FETCH_ASSOC) ;
                           foreach ($res_one as $val) {
                                ?>
                                <option value="<?= $val['codeTrans'] ?>"><?= $val['type'] ?></option>
                              <?php
                           }
                              ?>
                    </select> <br>
                    description : <br>
                    <select name="codeDesc" class="form-control" >
                      <option value="">-- choise un description--</option>
                          <?php
                            $sql = "SELECT codeDesc,description FROM description_voyage  " ;
                            $req=$con->prepare($sql);
                            $req->execute();
                            $res_two=$req->fetchAll(PDO::FETCH_ASSOC);
                             foreach ($res_two as $val) {
                                ?>
                                <option value="<?= $val['codeDesc'] ?>"><?= $val['description'] ?></option>
                              <?php
                             }
                              ?>
                    </select> <br>
                    prixTicket: <br>
                    <input type="numbdr" name="prixTicket" class="form-control" value="<?= $res['prixTicket'] ?>"> <br>
                    duree : <br>
                    <input type="time" name="duree" class="form-control" value="<?= $res['duree'] ?>"> <br>
                    heureDepart : <br>
                    <input type="time" name="duree" class="form-control" value="<?= $res['heureDepart'] ?>"> <br>

                    <input type="submit" name="modifer" value="Modifer " class="btn_style btn form-control "> <br>
           </form>    
      </div>
      <?php 
      include $includes.'footer.php' ;
         }else{
            header("location:../pages/connEmp.php") ;
         }
?>