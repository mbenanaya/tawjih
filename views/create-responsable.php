<?php
   include('./controllers/session-admin.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Utilisateurs | Responsable</title>
   <style>
      body {
         margin-top: 20px;
         background-color: #eee;
      }
   </style>
</head>

<body>
   <!-- start header  -->
   <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
      <?php include('./views/assets/inlcudes/header-admin.php');  ?>
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
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/responsables">Responsables</a></li>
                  <li class="breadcrumb-item active">create</li>
               </ol>
            </nav>
         </div>

         <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show" id='messageError'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                     class="mdi mdi-close"></i></span>
            </button>
         </div>

         <!-- START FORM -->
         <form id='formResponsable'>
            <!-- strat profile -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark" style="font-size: 1.3rem;"> Profil
                     </div>
                     <div class="card-body">
                        <div class="row mt-2">
                           <div class="col-12 col-md-6 col-lg-6 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab"> Prénom</label>
                              <input class="form-control border-primary" name='fname' type="text" id="prenom"
                                 placeholder='Prénom'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab">Nom</label>
                              <input type="text" name="lname" class="form-control border-primary" placeholder="Nom"
                                 id="nom">
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-12 col-md-6 col-lg-6 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab"> CIN:</label>
                              <input class="form-control border-primary" name='cinRes' type="text" value=""
                                 placeholder='CIN'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab">Date de naissance</label>
                              <input type="date" name="dateNaissRes" class="form-control border-primary" >
                           </div>
                        </div>

                        <div class="row mt-2">
                           <div class="col-12 col-md-6 col-lg-6 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab"> Téléphone</label>
                              <input class="form-control border-primary" name="teleRes" type="text" value=""
                                 placeholder='Téléphone'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab">Nom d'affichage</label>
                              <input type="text" name="nomAffichage" class="form-control border-primary"
                                 placeholder="Nom d'affichage" >
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-12 col-md-12">
                              <label class="text-dark mb-1" for="inputLastNameArab"> E-mail</label>
                              <input type="email" name="emailRes" pattern="[^ @]*@[^ @]*"
                                 class="form-control border-primary" placeholder="E-mail" >
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <!-- end profile -->
            <!-- strat profile -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark" style="font-size: 1.3rem;"> Informations
                        Supplémentaire
                     </div>
                     <div class="card-body">
                        <div class="row mt-2">
                           <div class="col-12 col-md-6 col-lg-6 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab"> N immatriculation/CNSS</label>
                              <input class="form-control border-primary" name='cnssRes' type="text" value=""
                                 placeholder='CNSS'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab">Salaire</label>
                              <input type="text" name="salaireRes" class="form-control border-primary"
                                 placeholder="Salaire" >
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-12 col-md-12 col-lg-12 mb-2">
                              <label class="text-dark mb-1" for="inputLastNameArab"> Date D'embauche:</label>
                              <input class="form-control border-primary" name='dateEmbaucheRes' type="date" value=""
                                 placeholder="Date D'embauche">
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-12 col-md-12">
                              <label class="text-dark mb-1">Address</label>
                              <input type="text" name="addressRes" class="form-control border-primary"
                                 placeholder="Address" >
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <!-- end profile -->

            <!--start upload photo -->
            <div class='row'>
               <div class='col-md-12 col-12'>
                  <div class="card-header bg-light  text-dark" style="font-size: 1.3rem;"> Photo
                  </div>
                  <div class='card' id="file">
                     <divn class="card-body">
                        <div class="form">
                           <div class="form-row">
                              <input class="file-input" type="file" name="photo" hidden accept="image/jpeg, image/png">
                              <i class="fas fa-cloud-upload-alt"></i>
                              <p>upload Photo</p>
                           </div>
                        </div>
                  </div>
               </div>
            </div>

            <div class="btns mb-3 float-end">
               <button type="submit" class="btn btn-success text-white px-4" style="font-weight: bolder"
                  id='btnSaveChange'>ENREGISTRER</button>
            </div>

         </form>
         <!-- END FORM -->

      </div>
   </main>
   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <!-- end scripts  -->
   <!-- script-dashboard-student  -->
   <?php include('./views/assets/inlcudes/script-dashboard-student.php'); ?>
   <script src='./views/assets/js/parametrage/responsable.js'></script>

   <!-- JavaScript sweetalert2-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- JavaScript sweetalert2-->


   <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>
   <!-- end scripts  -->
</body>

</html>