<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Informations Whatsapp</title>
   <style>
      body {
         margin-top: 20px;
         background-color: #eee;
      }
      .error {
         color: red;
         margin-top: .5rem;
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
                  <li class="breadcrumb-item active">whatsapp</li>
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

         <form id='formWhatsapp'>

            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark"> Informations Whatsapp
                     </div>
                     <div class="card-body">
                        <div class="row mt-3">
                           <div class="col-12 col-md-6 col-lg-6 mb-3">
                              <label class="text-dark mb-1" for="numWhatsapp"> Numero Whatsapp</label>
                              <input class="form-control border-primary" id="numWhatsapp" name="numWhatsapp" type="text" 	placeholder='Numero Whatsapp'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-3">
                              <label class="text-dark mb-1" for="messageWhatsapp">Message</label>
                              <input type="text" class="form-control border-primary" name="messageWhatsapp" id="messageWhatsapp" placeholder="Message"
                              >
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>

            <div class="btns mb-3 float-end">
               <button type="submit" class="btn btn-success text-white px-4" style="font-weight: bolder"
                  id='saveWhatsappData' name='saveWhatsappData'>ENREGISTRER</button>
            </div>

      <!-- </div> -->
      </form>
      </div>

   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js"
      integrity="sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
      integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
      integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_fr.min.js"
      integrity="sha512-J09lQZepqsxLm1HOKW1ljCSU9Ua87itcnjqRTlKIheEWbGlMO90QQK0Mj/eshCqdoUsADzNisjqr1X8D3hN1cw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
      integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js"
      integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   
   <script src='./views/assets/js/whatsapp.js'></script>
   <?php //include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <script src="./views/assets/js/main.js"></script>
   
   <script src="./views/assets/js/dashboard.js"></script>

</body>

</html>