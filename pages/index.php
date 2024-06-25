    <?php 
    session_start() ;
    if(!empty($_SESSION['user'])){
      include 'init.php' ;
      include $includes.'header.php' ;
      require_once $includes.'navbar.php' ;
    ?>
           <div class="container  container_index py-5 " style="width: 100%;height:90vh;">
               <h1 style="text-align: center;color:silver;">EVALUATION DE FIN DE MODULE REGINALE <br> AU TITRE DE L'ANNEE : 2023-2024 </h1>
               <div class="row " >
                    <img src="../images/page1.jpg" class="col-12"  height="auto" alt=""> 
                    <img src="../images/page2.jpg" class="my-5 col-12"   height="auto" alt="">
               </div> 
           </div>
   <?php
     include $includes.'footer.php' ;
    }else{
      header("location:connEmp.php") ;
    }
   ?>