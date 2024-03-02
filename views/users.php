<?php
      include('./controllers/session-admin.php'); 
      /* include './models/db.php';
      $db = new Db();
      $users =$db->selectDb('SELECT * FROM  admin');
      $userActive = $db->selectDb("SELECT * FROM admin WHERE active = 1 "); */

      $users=[];


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.2/sweetalert2.min.css">
   <title>Utilisateurs</title>
   <style>
      body {
         margin-top: 20px;
         background-color: #eee;
      }
   </style>
</head>

<body>
   <!-- start header  -->
   <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
      <?php include('./views/assets/inlcudes/header-admin.php');  

      
         $users = $cuser->getAllUsers();
         $userActive = $cuser->selctAdminActive();
     

      
      ?>
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
                  <li class="breadcrumb-item active">Utilisateurs</li>
               </ol>
            </nav>
         </div>

         <div class="alert alert-success solid alert-right-icon alert-dismissible fade show" id='messageSuccess'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"
               onclick="CloseSuccess()"><span><i class="mdi mdi-close"></i></span>
            </button>opération réussie.
         </div>

         <div class="mb-2">
            <!-- Button trigger modal -->
            <a href="<?php echo BASE_URL ?>/create-user" class="btn text-white px-3" style="background: #57ae74;">
               <i class="fa-solid fa-plus"></i>
               <span class="ms-2">Create</span>
            </a>
            <a href="<?php echo BASE_URL ?>/responsables" class="btn text-white px-3 me-1" style="background: #829AFF;">
               <i class="fa-solid fa-list"></i>
               <span class="ms-2">Responsables</span>
            </a>
         </div>

         <div class='row'>
            <div class='col-md-12'>
               <div class=''>
                  <div class="table-responsive">
                     <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                           <tr>
                              <th scope="col">PHOTO</th>
                              <th scope="col">nom</th>
                              <th scope="col">E-MAIL</th>
                              <th scope="col">TÉLÉPHONE</th>
                              <th scope="col">ACTIF</th>
                              <th scope="col" style="width: 200px;">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                         
                           <?php
                              if(isset($users)) {  
                                 while($user = $users->fetch(PDO::FETCH_OBJ)){?>
                           <tr>
                              <td>
                                 <img src="<?php if(empty($user->photo)){?>https://bootdey.com/img/Content/avatar/avatar1.png<?php }else{?>
                                    ./views/assets/images/images-admin/<?php echo $user->photo; }?>" alt=""
                                    class="avatar-sm rounded-circle me-2" />
                              </td>
                              <td>
                                 <?php echo $user -> fname . ' ' . $user -> lname ; ?>
                              </td>
                              <td><?php echo $user -> email ;?></td>
                              <td><?php echo $user -> tele;?></td>
                              <td>
                                 <div class="basic-form" id="btn_switch" <?php if($user->id_admin == $_SESSION['adminInfo']['id_admin']){?>
                                    style="display:none;" <?php } ?>>
                                    <div class="btnSwitch">
                                       <label class="toggle">
                                          <input type="checkbox" onclick="changeActive(<?php echo $user->id; ?>)"
                                             <?php if($user ->active){?> checked <?php };?>>
                                          <span class="slider"></span>
                                       </label>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <ul class="list-inline mb-0">
                                   <li class="list-inline-item">
                                       <a href="<?php echo BASE_URL ?>/?page=edit-user&id=<?php echo $user->id ; ?>" data-bs-toggle="tooltip"
                                          data-bs-placement="top" title="Edit" class="px-2 text-primary"><i
                                             class="bx bx-pencil fs-4"></i></a>
                                    </li>
                                     <li class="list-inline-item" <?php if($user->id_admin == $_SESSION['adminInfo']['id_admin']){?>
                                    style="display:none;" <?php } ?>>
                                       <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                          title="Delete" class="px-2 text-danger" onclick="deleteUser(event,<?php echo $user->id; ?>)"><i class='fa-solid fa-trash-can'
                                             style='color: #d80e0e;font-size: 20px'></i></a>
                                    </li>
                                 </ul>
                              </td>
                           </tr>

                           <?php } }
                           ?>

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">

               <div class="card">
                  <div class="card-header bg-light fs-4 text-dark">
                     Utilisateurs actifs
                  </div>
                  <div class="card-body">
                     <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <p class="text-dark">Utilisateurs actifs</p>
                           <strong id='nbrUsersActive'><?php echo $userActive ->rowCount(); ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <p class="text-dark">Nombre d'utilisateur</p>
                           <strong id='nbrUsers'><?php echo $users -> rowCount() ;?></strong>
                        </li>
                     </ul>
                  </div>
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
   <!-- end scripts  -->
   <script src='./views/assets/js/parametrage/user.js'></script>
   <!-- CSS -->
</body>

</html>