<!-- <?php
      include('./controllers/session-admin.php'); 
      /* include './models/db.php';
      $db = new Db();
      $webSiteInfo =$db->selectDb('SELECT * FROM  website LIMIT 1')->fetch(PDO::FETCH_OBJ); */
      
     

?> -->
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Setting | site web</title>
   <style>
      body {
         margin-top: 20px;
         background-color: #eee;
      }
   </style>
</head>

<body style="background-color: #eee;">
   <!-- start header  -->
   <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
      <?php  include('./views/assets/inlcudes/header-admin.php');  

      $webSiteInfo = $website; 

      
      
      ?>
      
   </header>
   <!-- end header  -->
   <!-- start sidebar  -->
   <aside id="sidebar" class="sidebar">
      <?php include('./views/assets/inlcudes/sidebar-admin.php'); ?>
   </aside>
   <!-- end  sidebar  -->
   <!-- MAIN -->
   <main id="main" class="main">

      <div class="container my-3">

         <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-admin">Home</a></li>
                  <li class="breadcrumb-item active">site web</li>
               </ol>
            </nav>
         </div>

         <div class="alert alert-success solid alert-right-icon alert-dismissible fade show" id='messageSuccess'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                     class="mdi mdi-close"></i></span>
            </button>les paramètres ont été mis à jour.
         </div>

         <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show" id='messageError'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                     class="mdi mdi-close"></i></span>
            </button>
         </div>

         <form method="post" id='formWebsite'>

            <!-- strat profile -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark"> Aperçu</div>
                     <div class="card-body">
                        <div class="row">

                           <div class="col-lg-6 col-md-6 col-12">
                              <label class="text-dark mb-1" for="inputLastNameArab">Site web</label>
                              <input type="text" name='siteWeb' class="form-control border-primary" placeholder="Nom"
                                 value="<?php echo !empty($webSiteInfo[0]['siteWeb']) ? $webSiteInfo[0]['siteWeb'] : '' ;?>"
                                 required>
                           </div>

                           <div class="col-12 col-md-6 col-lg-6">
                              <label class="text-dark mb-1" for="inputLastNameArab"> Téléphone</label>
                                 <input class="form-control border-primary" id="inputLastNameArab" type="text"
                                    placeholder='Téléphone' name='tele'
                                    value="<?php echo !empty($webSiteInfo[0]['tele']) ? $webSiteInfo[0]['tele'] : '' ;?>">
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-12 col-md-12 col-lg-12 mb-3">
                           <label class="text-dark mb-1" for="inputLastNameArab"> Email</label>
                              <input class="form-control border-primary" type="text" placeholder='Email' name='email'
                                 value="<?php echo !empty($webSiteInfo[0]['email'])  ? $webSiteInfo[0]['email'] : '' ;?>">
                           </div>
                           <!-- ouahki mohamed add smtp password for send email dynamic -->
                           <div class="col-12 col-md-12 col-lg-12 mb-3">
                           <label class="text-dark mb-1" for="inputLastNameArab"> SMTP PASSWORD de cet Email</label>
                              <input class="form-control border-primary" type="text" placeholder='SMTP password' name='smtp_password'
                                 value="<?php echo !empty($webSiteInfo[0]['smtp_password'])  ? $webSiteInfo[0]['smtp_password'] : '' ;?>">
                           </div>  
                        </div>                                                 
                     </div>
                  </div>

               </div>
            </div>
            <!-- end profile -->
            <!-- strat Adresse -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark"> Adresse
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-12 mb-3">
                              <label class="text-dark mb-1" for="inputLastNameArab">Address </label>
                              <input type="text" class="form-control border-primary" placeholder="Address"
                                 value="<?php echo !empty($webSiteInfo[0]['address'])  ? $webSiteInfo[0]['address'] : '' ;?>"
                                 name="address" required>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <!-- end Adresse -->
            <!-- start Contenu de la page d'accueil -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark"> Contenu de la page d'accueil</div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-12 col-md-6 col-lg-6 mb-3">
                              <label class="text-dark mb-1 d-block" for="inputLastNameArab" style="text-align: right;"> نبذة عن الموقع </label>
                              <textarea placeholder="نبذة عن الموقع" class="form-control" dir="rtl"
                                 name="aproposDuSite"><?php echo !empty($webSiteInfo[0]['AproposDuSite']) ? $webSiteInfo[0]['AproposDuSite']: '' ;?></textarea>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-3" dir="rtl">
                              <label class="text-dark mb-1 d-block" for="inputLastNameArab" style="text-align: right;height: max-content;">من نحن </label>
                              <textarea placeholder="من نحن" class="form-control"
                                 name='quiSommesNous'><?php echo !empty($webSiteInfo[0]['QuiSommesNous']) ? $webSiteInfo[0]['QuiSommesNous'] : '' ;?></textarea>
                           </div>
                        </div>

                     </div>
                  </div>

               </div>
            </div>
            <!-- end Contenu de la page d'accueil -->

            <!-- strat Adresse -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark"> Réseaux Sociaux
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-12 col-md-4 col-lg-4">
                              <label class="text-dark mb-1" for="inputLastNameArab">Twitter</label>
                              <input class="form-control border-primary" name="twitter" type="text"
                                 value="<?php echo !empty($webSiteInfo[0]['twitter'])  ? $webSiteInfo[0]['twitter'] : '' ;?>"
                                 placeholder='Twitter'>
                           </div>
                           <div class="col-lg-4 col-md-4 col-12">
                              <label class="text-dark mb-1" for="inputLastNameArab">Facebook</label>
                              <input type="text" class="form-control border-primary" name='facebook'
                                 value="<?php echo !empty($webSiteInfo[0]['facebook'])  ? $webSiteInfo[0]['facebook'] : '' ;?>"
                                 placeholder="Facebook">
                           </div>
                           <div class="col-lg-4 col-md-4 col-12">
                              <label class="text-dark mb-1" for="inputLastNameArab">Youtube</label>
                              <input type="text" class="form-control border-primary" placeholder="Youtube"
                                 value="<?php echo !empty($webSiteInfo[0]['youtube'])  ? $webSiteInfo[0]['youtube']: '' ;?>"
                                 name='youtube'>
                           </div>
                           <div class="col-lg-4 col-md-4 col-12">
                              <label class="text-dark mb-1" for="inputLastNameArab">Instagrame</label>
                              <input type="text" class="form-control border-primary" placeholder="Instagrame"
                                 value="<?php echo !empty($webSiteInfo[0]['instagrame'])  ? $webSiteInfo[0]['instagrame'] : '' ;?>"
                                 name='instagrame'>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <!-- end Adresse -->
            <!--start upload photo -->
            <div class='row'>
               <div class='col-md-12 col-12'>
                  <div class="card-header bg-light text-dark">Logo du site Web
                  </div>
                  <div class='card' id="file">
                     <divn class="card-body">
                        <div class="form">

                           <div class="form-row">
                              <?php
                             if(!empty($webSiteInfo[0]['logo'])){?>
                              <img src="./views/assets/images/logos/<?php echo $webSiteInfo[0]['logo']; ?>" alt=""
                                 height="100px" width="150px" id='imageClick'>
                              <input class="file-input" type="file" name="logo" hidden id='logo'>
                              <?php }else{?>
                              <input class="file-input" type="file" name="logo" hidden id='logo'>
                              <i class="fas fa-cloud-upload-alt"></i>
                              <p>upload Logo</p>
                              <?php }?>
                           </div>
                        </div>
                  </div>
               </div>
            </div>

            <div class="btns mb-3 float-end">
               <button type="button" class="btn btn-success text-white px-4" style="font-weight: bolder"
                  id='btnSaveChange' name='btnSaveChange'>ENREGISTRER</button>
            </div>

      </div>
      </form>
      </div>

   </main>

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
   <!-- end scripts  -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script src='./views/assets/js/parametrage/webSite.js'></script>   

</body>

</html>