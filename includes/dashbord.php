<?php 
   
        $codeEmp= $_SESSION['codeEmp'] ;
        $sql="SELECT `codeEmp`, `user`, photo_profile FROM `employe` WHERE `codeEmp`=?";
        $req=$con->prepare($sql);
        $req->execute([$codeEmp]);
        $res_dashbord=$req->fetch(PDO::FETCH_ASSOC);
?>
<section class="dashbord  " >
    <div class="div_info_admin py-1" style="border-bottom: 2px solid  #333;">
        <a href="profile.php?codeEmp=<?= $codeEmp ?>">
        <img src="../upload_images/<?= $res_dashbord['photo_profile'] ;?>" width="50px" height="50px" class="img-dash-admin" alt=""> 
        <span><?= $res_dashbord['user'] ; ?></span>
        </a>
    </div>
    <ul class="ul_dashbord">
        <li><a href="index.php">les employes</a></li>
        <li><a href="les_inscription_Emp.php">les inscriptions</a></li>
        <li><a href="les_voyages.php">les voyages</a></li>
        <li><a href="les_transports.php">les transports</a></li>
        <li><a href="les_desc_voy.php">les description de voyage  </a> </li>
       
        <li style="width: 100%;border:1px solid #333"></li>

        <li><a href="insert_emp.php">insert employe </a></li>
        <li><a href="insert_transport.php">insert transport </a></li>
        <li><a href="insert_voy.php">insert voyage </a></li>
        <li><a href="insert_desc.php">insert description </a></li>

        <li style="width: 100%;border:1px solid #333"></li>

       

        <li class="li_logout" ><a href="deconnecter.php">Se déconnecter</a></li>
    </ul>
</section>