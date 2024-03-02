<?php
   include('./controllers/SessionResponsable.php'); 

   if (!isset($_GET['typeUser']) || !isset($_GET['id'])) {
      header('Location:'.BASE_URL.'/messages-responsable');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Chat | Admin</title>
</head>

<body style="background-color: #eee;">
   <!-- start header  -->
   <header id="header" class="header fixed-top d-flex align-items-center bg-primary">
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
      <section class="chat-area mt-4 pt-4" style="position: static;bottom:auto;right:auto;">
         <div class="row d-flex justify-content-center">
            <div class="col-md-8">
               <div class="chat-form" style="display:block;width:auto;">
                  <header style="background-color:#4F91E8;">
                     <div class="content">
                        <img src="./views/assets/images/students/photo-profile.jpg" id="photo" alt="">
                        <div class="details">
                           <span class="name" id='fullName'></span>
                           <span class="status" id='isOnligne' style="text-align: left;">en ligne</span>
                        </div>
                     </div>
                  </header>
                  <div class="chat-box" id="chat_with_User" style="height:400px;background-color: #F7E6DE;">
                     <!-- MESSAGES -->
                  </div>
                  <form action="#" class="type-area" id="type-area" autocomplete="off" style="background-color: #F7E6DE;">
                     <!-- <input type="text" value="" name="outgoing_id" hidden> -->
                     <input type="text" value="<?php echo $_GET['id'] ?>"
                      name="<?php echo $_GET['typeUser'] == 'responsable' ? 'id_responsable':'id_student' ?>" hidden>
                     <input type="text" name="typeUser" value="<?php echo $_GET['typeUser'] ?>" hidden>
                     <input type="text" placeholder="Tapez un message ici..." class="input-field" name="message">
                     <button id="sendBtnChatAdm"><i class="fab fa-telegram-plane"></i></button>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </main>
   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
   <!-- end scripts  -->
   <script src="./views/assets/js/chat/chatAdmin.js"></script>

</body>

</html>