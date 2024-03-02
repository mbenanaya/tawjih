<?php include('./controllers/session-student.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Videos</title>
   <style>
      /* .swal-button--confirm {
         width: 150px;
         } */
   </style>
</head>

<body style="background-color: #eee;">

   <!-- start header  -->
   <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
      <?php include('./views/assets/inlcudes/header-student.php');  ?>
   </header>
   <!-- end header  -->
   <!-- start sidebar  -->
   <aside id="sidebar" class="sidebar">
      <?php include('./views/assets/inlcudes/sidebar-student.php'); ?>
   </aside>
   <!-- end  sidebar  -->
   <!--Show All Notifications Modal -->
   <div class="modal fade" id="allNotifsModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="ModalLabel">كل الاشعارات</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <ul id="all_notifs" class="list-unstyled"></ul>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
            </div>
         </div>
      </div>
   </div>

   <!-- MAIN -->
   <main id="main" class="main">

      <div class="container my-3">

         <!-- <div class="pagetitle "> -->
            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
               <nav>
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo BASE_URL."/dashboard-student" ?>">Home</a></li>
                     <li class="breadcrumb-item active">videos</li>
                  </ol>
               </nav>
            </div>
            <!-- <div> -->

            </div>
         </div>

         <div class="p-4">
            <!-- start modal -->
            <div class="row mb-4">
               <div class="col-md-12">

                  <button type="button" class="btn btn-primary px-4" id="btnFilter">
                     <i class="fa-solid fa-caret-down fs-6"></i> Filtrer
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                           <div class="modal-header bg-light">
                              <h5 class="modal-title" id="exampleModalLabel" style='text-align: right;'>Afficher
                                 uniquement :</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <!-- <form> -->
                                 <div class="mb-3">

                                 </div>
                                 <div class="mb-3">
                                    <div>

                                    </div>
                                 </div>
                              <!-- </form> -->
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary px-2" id="filtrer">Filtrer</button>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <!-- end modal -->
            <div class="row cards_vedios" id="cards-articles">

               <!-- <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                  <div class="card">
                     <iframe width="100%" height="215px" src="https://www.youtube.com/embed/gaKB4Wk99wc"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                     <div class="card-body d-flex flex-column">
                        <a href="#" class='text-center pt-3 pb-3 title-article'>CPGE
                           شرح الترشيح الأقسام التحضيرية
                        </a>
                        <small class='text-muted text-center'>06-07-2023</small>
                     </div>
                  </div>
               </div> -->

               <!-- <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                  <div class="card">
                     <iframe width="100%" height="215px" src="https://www.youtube.com/embed/4ZUy0oGoxvY"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                     <video width='100%' height='215px'  controls>
                        <source src='./uploads/articles/videos/1683967986_1683643451_python-modules-sys_ggTLOmdp (1).mp4' type='video/mp4'>
                     </video>

                     <div class="card-body d-flex flex-column">
                        <a href="#" class='text-center pt-3 pb-3 title-article'>
                           Présélection IFPS sante Techniciens Ambulanciers 2022
                        </a>
                        <small class='text-muted text-center'>09-12-2022</small>
                     </div>
                  </div>
               </div> -->
              
               <div class='col-md-12 py-5 my-5'> 
                  <p class='text-center'>Veuillez patienter jusqu'à ce que tous les videos soient téléchargés....</p>
               </div>

            </div>

            <div class="row">
               <div class="col-md-12 d-flex justify-content-center">
                  <button type="button" class="btn btn-danger px-2 fs-5">تحميل المزيد من فيديوهات</button>
               </div>
            </div>
         </div>
         <!-- CHAT BOX -->

   </main>

   <!-- start  CHAT AREAT FOR STUDENT -->
   <?php include('./views/chat.php'); ?>
   <!--end  CHAT AREAT FOR STUDENT -->

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <!-- end scripts  -->
   <!-- script-dashboard-student  -->
   <?php include('./views/assets/inlcudes/script-dashboard-student.php'); ?>
   <script src='./views/assets/js/vedios.js'></script>
   <!-- JavaScript sweetalert2-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>