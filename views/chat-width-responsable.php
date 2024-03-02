<?php 
include('./controllers/session-student.php');

if (!isset($_GET['id'])) {
   header('Location:'.BASE_URL.'/dashboard-student');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Chat</title>
</head>

<body style="background-color: #eee;">
   <!-- start header  -->
   <header id="header" class="header fixed-top d-flex align-items-center bg-primary">
      <?php include('./views/assets/inlcudes/header-student.php');  ?>
   </header>
   <!-- end header  -->
   <!-- start sidebar  -->
   <aside id="sidebar" class="sidebar">
      <?php include('./views/assets/inlcudes/sidebar-student.php'); ?>
   </aside>
   <!-- end  sidebar  -->

   <!-- MAIN -->
   <main id="main" class="main">
      <section class="chat-area mt-4 pt-4" style="position: static;bottom:auto;right:auto;">
         <div class="row d-flex justify-content-center">
            <div class="col-md-8">
               <div class="chat-form" style="display:block;width:auto;">
                  <header style="background-color:#4F91E8;">
                     <div class="content">
                        <img src="./views/assets/images/students/photo-profile.jpg" id="photoStudent" alt="">
                        <div class="details">
                           <span class="name" id='fullName'></span>
                           <span class="status" id='isOnligne' style="text-align: left;">en ligne</span>
                        </div>
                     </div>
                  </header>
                  <div class="chat-box" id="chat_with_admin" style="height:400px;background-color: #F7E6DE;">
                     <!-- MESSAGES -->
                  </div>
                  <form action="#" class="type-area" id="type-area" autocomplete="off" style="background-color: #F7E6DE;">
                     <!-- <input type="text" value="" name="outgoing_id" hidden> -->
                     <input type="text" value="<?php echo $_GET['id'] ?>" name="id_responsable" hidden>
                     <input type="text" placeholder="Tapez un message ici..." class="input-field" name="message">
                     <button id="sendBtnChatStudent"><i class="fab fa-telegram-plane"></i></button>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </main>
   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <!-- end scripts  -->
   <script src="./views/assets/js/chat/chat-width-responsable.js"></script>
   <?php include('./views/assets/inlcudes/script-dashboard-student.php'); ?>

</body>

</html>