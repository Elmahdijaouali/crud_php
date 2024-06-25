
        <!-- test -->
        <nav class="navbar p-0 navbar-expand-lg navbar-light ">
               <div class="container">
                <a class="navbar-brand " style="color: white;" href="index.php"> EFM php </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                   <?php 
                        
                         if( isset($_SESSION['nom']) &&   isset($_SESSION['fonction']) ){  ?>     
                               <li class="nav-item py-2 ">
                                    <a class="nav-link text-white " href="profile.php">profile </a>
                              </li>
                               <li class="nav-item py-2">
                                   <a class="nav-link text-white " href="sinscrire.php">S'inscrire </a>
                                </li>
                              <li class="nav-item py-2">
                                 <a class="nav-link text-white " href="listeIns.php">List de Voyages  </a>
                              </li>
                              <li class="nav-item py-2">
                                  <a class="nav-link text-white " href="contact_support.php">contact support </a>
                              </li>
                              <li class="nav-item py-2">
                                  <a class="nav-link text-white " href="deconnecter.php">Se déconnecter  </a>
                              </li>
                     <?php  } ?>  

                  </ul>
                
            </div>
         </div>
       </nav>