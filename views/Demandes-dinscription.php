<?php
include('./controllers/session-admin.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <link rel="stylesheet" href="./views/assets/css/demandesInscription.css">
   <title>Demandes d'inscription</title>
</head>

<body style="background-color: #eee;">
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
                  <li class="breadcrumb-item active">Demandes d'inscription</li>
               </ol>
            </nav>
         </div>

         <div class="row">
            <div class="col-xl-12">
               <div class="card">
                  <div class="card-body">
                     <h5 class="header-title pb-3 mt-0">Demandes d'inscription</h5>
                     <div class="table-responsive">
                        <table class="table table-hover mb-0">
                           <thead>
                              <tr class="align-self-center">                                 
                                 <th>Nom</th>
                                 <th>Téléphone</th>
                                 <th>Email</th>
                                 <th>Payement</td>
                                 <th>Date</th>
                                 <th>Pack</th>
                                 <th>Prix</th>
                                 <th>Status</th>
                                 <th>Responsable</th>
                                 <th>Action</th>
                                 <!-- <th>Transaction</th> -->
                              </tr>
                           </thead>
                           <tbody id="tboadyDemandes">
                                 <tr style="height: 5opx;">
                                    <td class='text-center' colspan="12">Veuillez attendre que toutes les demandes soient chargées</td>
                                 </tr>
                           </tbody>
                        </table>
                     </div>
                     <!--end table-responsive-->
                     <div class="pt-3 border-top text-right"><a href="#" class="text-primary">View all <i
                              class="mdi mdi-arrow-right"></i></a></div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </main>

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <!-- end scripts  -->
   <script src='./views/assets/js/demandesInscription.js'></script>

   <!-- script-dashboard-student  -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
</body>

</html>