<?php
include('./controllers/session-admin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Dashboard | Admin</title>
   <style>
      .order-card {
         color: #fff;
      }

      .bg-c-blue {
         background: linear-gradient(45deg, #4099ff, #73b4ff);
      }

      .bg-c-green {
         background: linear-gradient(45deg, #2ed8b6, #59e0c5);
      }

      .bg-c-yellow {
         background: linear-gradient(45deg, #FFB64D, #ffcb80);
      }

      .bg-c-pink {
         background: linear-gradient(45deg, #FF5370, #ff869a);
      }


      .card {
         border-radius: 5px;
         -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
         box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
         border: none;
         margin-bottom: 30px;
         -webkit-transition: all 0.3s ease-in-out;
         transition: all 0.3s ease-in-out;
      }

      .card .card-block {
         padding: 25px;
      }

      .order-card i {
         font-size: 26px;
      }

      .f-left {
         float: left;
      }

      .f-right {
         float: right;
      }

      label.error {
         color: red;
         margin-top: .5rem;
      }
   </style>
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
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL . "/dashboard-admin" ?>">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </nav>
         </div>

         <!-- <h2>Statistiques du site</h2> -->
         <div class='col-md-12'>
            <div class="card">
               <div class="card-header bg-light  text-dark" style="font-size: 1.3rem;"> Filtrer par jour
               </div>
               <div class="card-body">
                  <form id="filterByDayForm">
                     <div class="row justify-content-between">
                        <div class='col-sm-7'>
                           <div class="form-group">
                              <label for="datedb">Choisissez une date</label>
                              <input type="date" id="datefil" name="datefil" class="form-control">
                           </div>
                        </div>

                        <div class="col-sm-7">
                           <button type="submit" id="filterByDay" name="filterByDay" class="btn btn-primary px-4 mt-2">Filtrer</button>
                        </div>
                     </div>
                  </form>
                  <div class="d-flex flex-column flex-md-row justify-content-evenly mt-4">
                     <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                           <div class="card-block">
                              <h6 class="m-b-20">Étudiants</h6>
                              <h2 class="text-right"><i class="fa-solid fa-users f-left"></i><span id="studNumbByDay"></span></h2>
                              <p class="m-b-0">Nombre total<span class="f-right" id="studTotalByDay"></span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-4 col-xl-3">
                        <div class="card order-card" style="background-color: #3DE398;">
                           <div class="card-block">
                              <h6 class="m-b-20">Concours</h6>
                              <h2 class="text-right"><i class="fa-solid fa-newspaper f-left"></i><span id="concNumbByDay"></span></h2>
                              <p class="m-b-0">Nombre total<span class="f-right" id="concTotalByDay"></span></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>


         <div class='col-md-12'>
            <div class="card">
               <div class="card-header bg-light  text-dark" style="font-size: 1.3rem;"> Filtrer par durée
               </div>
               <div class="card-body">
                  <form id="staticsForm">
                     <div class="row">

                        <div class='col-sm-6'>
                           <div class="form-group">
                              <label for="datedb">Date de début</label>
                              <input type="date" id="datedb" name="datedb" class="form-control">
                           </div>
                        </div>

                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="datefin">Date de fin</label>
                              <input type="date" id="datefin" name="datefin" class="form-control">
                           </div>
                        </div>

                        <div class="col-sm-5">
                           <button type="submit" id="filterByDuration" name="filterByDuration" class="btn btn-primary px-4 mt-2">Filtrer</button>
                        </div>

                     </div>
                  </form>
                  <div class="d-flex flex-column flex-md-row justify-content-evenly mt-4">
                     <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                           <div class="card-block">
                              <h6 class="m-b-20">Étudiants</h6>
                              <h2 class="text-right"><i class="fa-solid fa-users f-left"></i><span id="studNumbByDuration"></span></h2>
                              <p class="m-b-0">Nombre total<span class="f-right" id="studTotalByDuration"></span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-4 col-xl-3">
                        <div class="card order-card" style="background-color: #3DE398;">
                           <div class="card-block">
                              <h6 class="m-b-20">Concours</h6>
                              <h2 class="text-right"><i class="fa-solid fa-newspaper f-left"></i><span id="concNumbByDuration"></span></h2>
                              <p class="m-b-0">Nombre total<span class="f-right" id="concTotalByDuration"></span></p>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>

         </div>

         <div class='col-md-12'>
            <div class="card">
               <div class="card-header bg-light  text-dark" style="font-size: 1.3rem;"> Nombre d'étudiants par pack
               </div>
               <div class="card-body">
                  <form id="packsForm">
                     <div class="row">

                        <div class='col-sm-6'>
                           <div class="form-group">
                              <label for="dateDbP">Date de début</label>
                              <input type="date" id="dateDbP" name="dateDbP" class="form-control">
                           </div>
                        </div>

                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="dateFinp">Date de fin</label>
                              <input type="date" id="dateFinp" name="dateFinp" class="form-control">
                           </div>
                        </div>

                        <div class="col-sm-5">
                           <button type="submit" id="filterPacksByDuration" name="filterPacksByDuration" class="btn btn-primary px-4 mt-2">Filtrer</button>
                        </div>

                     </div>
                  </form>
                  <div id="counts" class="row mt-4"></div>
               </div>
            </div>

         </div>
        
      </div>
   </main>

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js" integrity="sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_fr.min.js" integrity="sha512-J09lQZepqsxLm1HOKW1ljCSU9Ua87itcnjqRTlKIheEWbGlMO90QQK0Mj/eshCqdoUsADzNisjqr1X8D3hN1cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="./views/assets/js/statics.js"></script>
   <!-- end scripts  -->

</body>

</html>