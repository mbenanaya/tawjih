<?php include('./controllers/session-student.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Student</title>
   <style>
      #all_notifs li {
         padding: 0 3rem 0 1rem !important;
         margin-top: .3rem !important;
         margin-bottom: .3rem !important;
      }
   </style>
</head>

<body class="bg-light">
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
      <div class="container my-5">
         <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-5 d-flex align-items-center">
            <!-- <h1>Dashboard</h1> -->
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL ."/dashboard-student" ?>">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </nav>
         </div>

         <div class="p-4">
            <div class="row" id="cards-articles"></div>
         </div>
         <!-- CHAT BOX -->

   </main>

   <!-- start  CHAT AREAT FOR STUDENT -->
   <?php include('./views/chat.php'); ?>
   <!--end  CHAT AREAT FOR STUDENT -->

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <!-- end scripts  -->

   <script src="./views/assets/js/show_articles.js"></script>
   <!-- script-dashboard-student  -->
   <?php //include('./views/assets/inlcudes/script-dashboard-student.php'); ?>

</body>

</html>