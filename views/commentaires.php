<?php
   include('./controllers/session-admin.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Commentaires | Admin</title>
   <style>
      body {
         /* padding-top: 30px; */
         background: #eee;
      }

      .widget .panel-body {
         padding: 0px;
      }

      .widget .list-group {
         margin-bottom: 0;
      }

      .widget .panel-title {
         display: inline;
      }

      .widget .label-info {
         float: right;
      }

      .widget li.list-group-item {
         border-radius: 0;
         border: 0;
         border-top: 1px solid #ddd;
      }

      .widget li.list-group-item:hover {
         background-color: rgba(86, 61, 124, 0.1);
      }

      .widget .mic-info {
         color: #666666;
         font-size: 11px;
      }

      .widget .action {
         margin-top: 5px;
      }

      .widget .comment-text {
         font-size: 12px;
      }

      .widget .btn-block {
         border-top-left-radius: 0px;
         border-top-right-radius: 0px;
      }

      .img-user {
         width: 80px;
         height: 100%;

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

         <!-- <div class="pagetitle "> -->
         <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL."/dashboard-admin" ?>">Home</a></li>
                  <li class="breadcrumb-item active">Commentaires</li>
               </ol>
            </nav>
         </div>

         <div class="row">
            <div class="panel panel-default widget">
               <div class="panel-heading  py-2 px-3 bg-light">
                  <span class="glyphicon glyphicon-comment"></span>
                  <h3 class="panel-title">
                     Commentaires récents </h3>
                  <!-- <span class="label label-info">
                     2</span> -->
               </div>
               <div class="panel-body">
                  <ul class="list-group" id='listGroupCommentaires'>

                     <!-- <li class="list-group-item">
                        <div class="row">
                           <div class="col-1">
                              <img
                                 src="views\assets\images\slide\young-man-student-with-notebooks-showing-thumb-up-approval-smiling-satisfied-blue-studio-background.jpg"
                                 class="img-circle img-responsive img-user" alt="" />
                           </div>

                           <div class="col-11">
                              <div>
                                 <h5>khalid lafhal</h5>
                              </div>
                              <div class="comment-text">
                                 hhhhhhhhhhhhhhhhhhhhhdhdhhdhdhddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                                 hhhhhhhhhhhhhhhhhhhhhdhdhhdhdhddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                                 hhhhhhhhhhhhhhhhhhhhhdhdhhdhdhddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                              </div>
                              <div class="action d-flex justify-content-between align-items-center">
                                 <div>
                                    <button type="button" class="btn btn-primary" title="Edit" style="font-size: 12px;">
                                       <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-dark" title="Approved"
                                       style="font-size: 12px;">
                                       publier
                                    </button>
                                    <button type="button" class="btn btn-danger" title="Delete"
                                       style="font-size: 12px;">
                                       <i class="fa-solid fa-trash"></i>
                                    </button>
                                 </div>
                                 <span>11 Nov 2013</span>
                              </div>
                           </div>
                        </div>
                     </li> -->

                  </ul>
                  <!-- <a href="#" class="btn btn-info btn-sm btn-block" role="button"><span
                        class="glyphicon glyphicon-refresh"></span> More</a> -->
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
   <script src='./views/assets/js/commentairesAdmin.js'></script>

</body>

</html>