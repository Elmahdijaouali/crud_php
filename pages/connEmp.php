  <?php
      session_start();
      include 'init.php' ;
      require_once $includes.'conxDB.php' ;
      $err="" ;
      if(isset($_POST['user']) && isset($_POST['pwd'])){
        $user=$_POST['user'];
        // crptage de mot de passe 
        $password=sha1($_POST['pwd']);
        if(empty($user) or empty($password) ){
          $err="les données d'authentification sont obligatoires " ;
        }else{
        $sql ="SELECT * FROM employe WHERE user=? AND pwd=?";
        $req=$con->prepare($sql);
        $req->execute([$user,$password]) ;
        $res=$req->fetch(PDO::FETCH_ASSOC) ; 
        if(empty($res)){
            $err="les données de conexion  sont incorrects  " ;
        }else{
            $_SESSION['user']=$res['user'] ;
            $_SESSION['nom']=$res['nom'] ;
            $_SESSION['codeEmp']=$res['codeEmp'] ;
            $_SESSION['fonction']=$res['fonction'] ; 
            if($res['idgroup'] == 1){
              $_SESSION['idgroup']=$res['idgroup'] ; 
              header("location:../admin/index.php");
            }else{
              header("location:sinscrire.php");
            }
        }
        }
      }
        include 'init.php' ;
        include $includes.'header.php' ;
       
 ?>
    <div class="container container-connEmp p-5">
        <div class="form col-12 col-md-8  col-lg-6 form-connEmp" >
            <form action="connEmp.php" method="post" class=" p-5" name="connEmp">
                <h1 style="text-align: center;">Connexion  </h1> <br>
                 <?php 
                 if($err != ""){
                  echo '<p style="text-align: center;color:red;">'. $err .'</p>';
                 }
                 ?>
                 <input type="text" name="user" class="form-control" placeholder="Username"> <br>
                 <input type="password" name="pwd" class="form-control" placeholder="Password"> <br>
                 <input type="submit" name="btn_connEmp" value="Connexion"  class="btn btn_style form-control"> <br>
            </form>
        </div>
    </div> 
   <?php
     include $includes.'footer.php' ;
   ?>