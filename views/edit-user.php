<?php
include('./controllers/session-admin.php');
     /*  include './models/db.php'; 
       $db = new Db() ;
$userId =  $_GET['id'];
if (isset($_GET['id'])) {
   /*       $user = $db->selectDb("SELECT * FROM admin  WHERE id = $userId")->fetch(PDO::FETCH_OBJ); */
   /* $user = $cuser->EditUser($userId); */
/* }  else { */
   /* header('Location: ./users'); */
/* } */ 
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
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

      $userId =  $_GET['id'];
      if (isset($_GET['id'])) {
         /*       $user = $db->selectDb("SELECT * FROM admin  WHERE id = $userId")->fetch(PDO::FETCH_OBJ); */
         $user = $cuser->EditUser($userId);
      } else {
         header('Location: ./users');
      }

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
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/users">Utilisateurs</a></li>
                  <li class="breadcrumb-item active"><?php if ($_SESSION['adminInfo']['id'] == $_GET['id']) { ?>Profile</li>
               <?php } else { ?> Create <?php } ?>
               </ol>
            </nav>
         </div>

         <div class="alert alert-success solid alert-right-icon alert-dismissible fade show" id='messageSuccess'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close" onclick="CloseSuccess()"><span><i class="mdi mdi-close"></i></span>
            </button>
            Les informations ont été modifiées avec succès
         </div>

         <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show" id='messageError'>
            <span><i class="mdi mdi-check"></i></span>
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
            </button>
         </div>
         <form id='formUserUpdate'>
            <!-- strat profile -->
            <div class='row'>
               <div class='col-md-12'>
                  <div class="card">
                     <div class="card-header bg-light  text-dark"> Profil
                     </div>
                     <div class="card-body">
                        <input type="text" name='idUser' id='idUser' value="<?php echo $user->id; ?>" hidden>
                        <div class="row mt-3">
                           <div class="col-12 col-md-6 col-lg-6 mb-3">
                              <label class="text-dark mb-1" for="inputLastNameArab"> Prénom</label>
                              <input class="form-control border-primary" name='fname' type="text" value="<?php echo $user->fname; ?>" placeholder='Prénom'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-3">
                              <label class="text-dark mb-1" for="inputLastNameArab">Nom</label>
                              <input type="text" name="lname" class="form-control border-primary" placeholder="Nom" required value="<?php echo $user->lname; ?>">
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-12 col-md-6 col-lg-6 mb-3">
                              <label class="text-dark mb-1" for="inputLastNameArab"> Téléphone</label>
                              <input class="form-control border-primary" name="tele" type="text" value="<?php echo $user->tele; ?>" placeholder='Téléphone'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-3">
                              <label class="text-dark mb-1" for="inputLastNameArab">Nom d'affichage</label>
                              <input type="text" name="nomAffichage" class="form-control border-primary" placeholder="Nom d'affichage" required value="<?php echo $user->nomAffichage; ?>">
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-12 col-md-12">
                              <label class="text-dark mb-1" for="inputLastNameArab"> E-mail</label>
                              <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control border-primary" placeholder="E-mail" required value="<?php echo $user->email; ?>">
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <!-- end profile -->
            <!-- start modPass -->
            <?php if ($_SESSION['adminInfo']['id'] == $_GET['id']) { ?>
               <div class='row'>
                  <div class='col-md-12'>
                     <div class="card">
                        <div class='card-body d-flex justify-content-between'>
                           <div class=" text-dark"> Mot de passe </div>
                           <button type="button" class="btn btn-outline-primary px-3" id='changePassword' style='padding: 6px 0px;'>
                              <span style="padding-left:8px;"><i class="fa-solid fa-pen"></i></span>
                              CHANGER LE MOT DE PASSE
                           </button>
                           <!-- start model  -->

                           <!--  end  model -->
                        </div>
                     </div>
                  </div>
               </div>
            <?php } ?>
            <!-- end modPass -->
            <!--start upload photo -->
            <div class='row'>
               <div class='col-md-12 col-12'>
                  <div class="card-header bg-light  text-dark"> Photo
                  </div>
                  <div class='card' id="file">
                     <divn class="card-body">
                        <div class="form">
                           <?php
                           if (!empty($user->photo)) { ?>
                              <img src="./views/assets/images/images-admin/<?php echo $user->photo; ?>" alt="" height="100px" width="150px" id='imageClick'>
                              <input class="file-input" type="file" name="photo" hidden>
                           <?php } else { ?>
                              <div class="form-row">
                                 <input class="file-input" type="file" name="photo" hidden>
                                 <i class="fas fa-cloud-upload-alt"></i>
                                 <p>upload Photo</p>
                              </div>
                           <?php } ?>
                        </div>
                  </div>
               </div>
            </div>

            <div class="btns mb-3 float-end">
               <button type="submit" class="btn btn-success text-white px-4" style="font-weight: bolder" id='btnUpdateUser'>ENREGISTRER</button>
            </div>
         </form>
      </div>
      <!--end upload photo -->

      </div>

   </main>

   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
   <!-- end scripts  -->
   <script src='./views/assets/js/parametrage/updateUser.js'></script>
   <!-- JavaScript sweetalert2-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- for keyboard arabic -->
   <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
   <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>

</body>

</html>