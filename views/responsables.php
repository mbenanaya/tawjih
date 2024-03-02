<?php
include('./controllers/session-admin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.2/sweetalert2.min.css">
   <title>Utilisateurs | Responsables</title>
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
                  <li class="breadcrumb-item active">Responsables</li>
               </ol>
            </nav>
         </div>

         <div class="alert alert-success solid alert-right-icon alert-dismissible fade show" id='messageSuccess'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"
               onclick="CloseSuccess()"><span><i class="mdi mdi-close"></i></span>
            </button>opération réussie.
         </div>

         <div class="mb-2">
            <!-- Button trigger modal -->
            <a href="<?php echo BASE_URL ?>/create-responsable" class="btn text-white px-3"
               style="background: #829AFF;">
               <i class="fa-solid fa-plus"></i>
               <span class="ms-2">Create</span>
            </a>
         </div>

         <div class='row'>
            <div class='col-md-12'>
               <div class="table-responsive">
                  <table class="table project-list-table table-nowrap align-middle table-borderless">
                     <thead>
                        <tr>
                           <th scope="col">PHOTO</th>
                           <th scope="col">NOM</th>
                           <th scope="col">E-MAIL</th>
                           <th scope="col">TÉLÉPHONE</th>
                           <th scope="col">DATE D'EMBAUCHE</th>
                           <th scope="col">ACTIF</th>
                           <th scope="col" style="width: 200px;">Action</th>
                        </tr>
                     </thead>
                     <tbody id="displayResponsables">

                     </tbody>

                  </table>
               </div>
            </div>
         </div>


         <div class="row">
            <div class="col-md-12">

               <div class="card">
                  <div class="card-header bg-light fs-4 text-dark">
                     Responsables actifs
                  </div>
                  <div class="card-body">
                     <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <p class="text-dark">Responsables actifs</p>
                           <strong id='nbrResponsablesActive'>2</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <p class="text-dark">Nombre Responsables</p>
                           <strong id='nbrResponsables'>10</strong>
                        </li>
                     </ul>
                  </div>
               </div>

            </div>
         </div>





      </div>
   </main>
   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
   <!-- JavaScript sweetalert2-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script src='./views/assets/js/parametrage/resnponsables.js'></script>

   <!-- end scripts  -->
   <!-- CSS -->
</body>

</html>