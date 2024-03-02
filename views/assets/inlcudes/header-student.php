<?php
require_once './controllers/auth.php';
$cuser = new Auth();

$website = $cuser->website(); 





?>
<div class="d-flex align-items-center justify-content-between">
   <a href="<?php echo BASE_URL ?>/dashboard-student" class="logo d-flex align-items-center">
   <img src="./views/assets/images/logos/<?php echo $website[0]['logo']; ?>"
         style="height: 50px;width: 50px;">
      <span class="d-none d-lg-block text-white ps-2"><?php echo $website[0]['siteWeb']; ?></span>
   </a>
   <span class="toggle-sidebar-btn text-white">
      <i class="fa-solid fa-bars"></i>
   </span>
</div>
<input type="hidden" id="idBac" name="idBac" readonly value="<?= $_SESSION['idBac'] ?>" />
<input type="hidden" id="student_id" name="student_id" readonly value="<?= $_SESSION['unique_id_student'] ?>" />
<div class="search-bar">
   <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
   </form>
</div>

<nav class="header-nav ms-auto">
   <ul class="d-flex align-items-center">
      <li class="nav-item d-block d-lg-none">
         <a class="nav-link nav-icon search-bar-toggle " href="#"> <i class="bi bi-search"></i> </a>
      </li>
      <li class="nav-item dropdown">
         <a id="notifs" class="nav-link nav-icon text-white" href="#" data-bs-toggle="dropdown">
            <i class="fa-regular fa-bell"></i>
            <span id="count" class="badge bg-primary badge-number"></span>
         </a>
         <ul id="notifs_list" class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications pt-3">
         </ul>
      </li>

      <li class="nav-item dropdown">

         <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"> <i class="fa-brands fa-rocketchat text-white"></i>
         <span class="badge bg-success badge-number" id="nbrNotifacationMsgForStd"></span> </a>
         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages" id="NotificationMessagesForStd">
            
            <!-- <li class="dropdown-header"> You have 3 new messages <a href="#"><span
                     class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>
            <li>
            </li>
            <li>
               <hr class="dropdown-divider">
            </li>

            <li class="message-item">
               <a href="#">
                  <img src="./views/assets/images/students/photo-profile.jpg" alt="" class="rounded-circle">
                  <div style="width: 100%;margin-top: -5px;">
                     <div class="d-flex justify-content-between">
                        <h3 class="m-0">khalid</h3>
                        <small class="time text-muted">5 mins ago</small>
                     </div>
                     <div class="d-flex justify-content-between">
                        <p class="text-muted m-0" style="font-size: 14px;margin: 0px 0px;">Hello, Are you there?</p>
                        <small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                     </div>
                  </div>
               </a>
            </li>

            <li class="dropdown-footer"> <a href="#">Show all messages</a></li> -->
         </ul>
      
      </li>
      <li class="nav-item dropdown pe-3">
         <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo $_SESSION['photo_student'] ; ?>" alt="Profile" class="rounded-circle">
            <span
               class="d-none d-md-block dropdown-toggle ps-2 text-white"><?php echo $_SESSION['firstName_student']." ".$_SESSION['lastName_student']; ?></span>
         </a>
         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
               <h6><?php echo $_SESSION['firstName_student']." ".$_SESSION['lastName_student']; ?></h6>
               <span>Etudiant</span>
            </li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <li>
               <a class="dropdown-item d-flex align-items-center" href="./profile">
                  <i class="bi bi-person"></i>
                  <span>Mes informations personnelles</span>
               </a>
            </li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <!--  <li>
               <a class="dropdown-item d-flex align-items-center" href="#">
                  <i class="bi bi-gear"></i> <span>Account Settings</span>
               </a>
            </li> -->
            <li>
               <hr class="dropdown-divider">
            </li>
            <li>
               <button class="dropdown-item d-flex align-items-center" id="needhelp">
                  <i class="bi bi-question-circle"></i>
                  <span>Besoin d'aide?</span>
               </button>
               <script>                                 
                  document.getElementById("needhelp").addEventListener("click",function(){
                     document.getElementById("open-chatbox").click();
                  }) 
               </script>
            </li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <li>
               <a class="dropdown-item d-flex align-items-center" href="./controllers/logout-student.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Déconnexion</span>
               </a>
            </li>
         </ul>
      </li>
   </ul>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- for chat -->
<!-- <script src="./views/assets/js/chat/chatbox.js"></script>
<script src="./views/assets/js/chat/studentChat.js"></script>  -->
<!-- for notification -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>


<script src="./views/assets/js/notifications.js"></script>