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
         <a class="nav-link nav-icon text-white" href="#" data-bs-toggle="dropdown">
            <i class="fa-brands fa-rocketchat"></i>
            <span class="badge bg-success badge-number"  id="nbrNotifacationMsgForAdm"></span>
         </a>
         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages" id='messagesForAdmin'>           
         </ul>
      
      </li>
      <li class="nav-item dropdown pe-3">
         <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="./views/assets/images/images-admin/<?php echo $_SESSION['photo_admin']?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2 text-white"></span>
         </a>
         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
               <h6><?php echo $_SESSION['adminInfo']['fname']." ". $_SESSION['adminInfo']['lname'];?></h6>
               <span>Admin</span>
            </li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <li>
               <a class="dropdown-item d-flex align-items-center" href="<?php echo BASE_URL ?>/?page=edit-user&id=<?php echo $_SESSION['adminInfo']['id'] ; ?>">
                  <i class="bi bi-person"></i>
                  <span>Mon Profile</span>
               </a>
            </li>
            <!-- <li>
               <hr class="dropdown-divider">
            </li> -->
            <!-- <li>
               <a class="dropdown-item d-flex align-items-center" href="#">
                  <i class="bi bi-gear"></i> <span>Account Settings</span>
               </a>
            </li> -->
            <!-- <li>
               <hr class="dropdown-divider">
            </li> -->
            <!-- <li>
               <a class="dropdown-item d-flex align-items-center" href="#">
                  <i class="bi bi-question-circle"></i>
                  <span>Need Help?</span>
               </a>
            </li> -->
            <li>
               <hr class="dropdown-divider">
            </li>
            <li>
               <a class="dropdown-item d-flex align-items-center" href="./controllers/logout-admin.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Déconnexion</span>
               </a>
            </li>
         </ul>
      </li>
   </ul>
</nav>
