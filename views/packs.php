<?php
   include('./controllers/session-admin.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Setting | PACKS</title>
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
      <?php  include('./views/assets/inlcudes/header-admin.php');  ?>
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
                  <li class="breadcrumb-item active">Packs</li>
               </ol>
            </nav>
         </div>

         <div class="mb-2">
            <!-- Button trigger modal -->
            <button class="btn text-white px-3" style="background: #57ae74;" id='add_pack'>
               <i class="fa-solid fa-plus"></i>
               <span class="ms-2">ajouter nouveau Pack</span>
            </button>
         </div>

         <div class="alert alert-success solid alert-right-icon alert-dismissible fade show" id='messageSuccess'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"
               onclick="CloseSuccess()"><span><i class="mdi mdi-close"></i></span>
            </button>opération réussie.
         </div>

         <div class='row'>
            <div class='col-md-12'>
               <div class="table-responsive">
                  <table class="table project-list-table table-nowrap align-middle table-borderless text-center">
                     <thead>
                        <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Domaine</th>
                           <th scope="col">Prix</th>
                           <th scope="col">Activ</th>
                           <th class='text-center' scope="col" style="width: 200px;">Action</th>
                        </tr>
                     </thead>
                     <tbody id='tbody_pack'>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

      </div>
   </main>

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
   <script src='./views/assets/js/parametrage/packs.js'></script>

   <!-- JavaScript sweetalert2-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- JavaScript sweetalert2-->

   <!-- for keyboard arabic -->
   <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
   <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>
   <!-- end scripts  -->

</body>

</html>