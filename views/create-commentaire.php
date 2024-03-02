<?php include('./controllers/session-student.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <title>Commentaire</title>
   <style>
      .card {
         border: 1px solid #007bff;
         border-radius: 5px;
         margin-bottom: 20px;
      }

      .card-header {
         background-color: #007bff;
         color: white;
         font-weight: bold;
         padding: 10px;
         border-radius: 5px 5px 0 0;
      }

      .card-body {
         padding: 10px;
      }

      .is-invalid {
         border-color: red;
      }

      .invalid-feedback {
         display: block;
         font-size: 14px;
         color: red;
         margin-top: 5px;
      }

      body {
         background: #eee;
      }

      .card {
         box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
      }

      .card {
         position: relative;
         display: flex;
         flex-direction: column;
         min-width: 0;
         word-wrap: break-word;
         background-color: #fff;
         background-clip: border-box;
         border: 0 solid rgba(0, 0, 0, .125);
         border-radius: 1rem;
      }

      .card-body {
         -webkit-box-flex: 1;
         -ms-flex: 1 1 auto;
         flex: 1 1 auto;
         padding: 1.5rem 1.5rem;
      }
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

         <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo BASE_URL."/dashboard-student" ?>">Home</a></li>
                  <li class="breadcrumb-item active">Commenataire</li>
               </ol>
            </nav>
         </div>

         <div class="row mt-3 pt-3">
            <div class="col-lg-12">
               <!-- Basic information -->
               <div class="card mb-4">
                  <div class="card-body">
                     <h3 class="h6 mb-4">créer une commentaire</h3>
                     <form action="#" method="POST" id="formCommentaire" enctype="multipart/form-data">
                        <div class="col-lg-12">
                           <div class="mb-3">
                              <!-- <label class="form-label">Titre De Concours :</label> -->
                              <textarea rows="" cols="" class='form-control' name='commentaire' id='commentaire'
                                 placeholder="Écrire un commentaire"></textarea>
                              <span class="text-danger pt-2" id='error'></span>

                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

         <div class='d-flex justify-content-end'>
            <button class="btn btn-primary px-3" id='btnEnvoyerCommentaire'>
               Envoyer
            </button>
         </div>

      </div>
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
   
   <script>
      const btnEnvoyerCommentaire = document.getElementById('btnEnvoyerCommentaire');
      const formCommentaire =document.getElementById('formCommentaire');
      const commentaire = document.getElementById('commentaire');
      const error = document.getElementById('error');
      formCommentaire.onsubmit = (e) =>{
         e.preventDefault();
      }
      commentaire.onkeyup = ()=>{
         error.style.display ='none';
      }
      btnEnvoyerCommentaire.onclick = ()=> {

         if (commentaire.value == '') {
            error.textContent = 'Veuillez écrire un commentaire';
            error.style.display = 'block';
         } else {
            error.style.display = 'none';
            const xhr = new XMLHttpRequest();
            xhr.open('POST','./controllers/CommentaireController.php',true);

            xhr.onload = ()=>{

               if (xhr.readyState == XMLHttpRequest.DONE) {
                  if (xhr.status == 200) {
                     const data =JSON.parse(xhr.response);

                     if (data.resultat == 'commentaire_inserted') {
                        formCommentaire.reset();
                        Swal.fire({
                           icon: "success",
                           text:"Merci pour votre commentaire, nous espérons que vous aimez notre service"
                       });
                     } else {
                     //    Swal.fire({
                     //       icon: "success",
                     //       title: "Félicitation",
                     //       text:'يرجى الانتظار حتى يتم قبولك. تحقق من البريد الالكتروني'
                     //   });
                     }
                     // console.log(data);
                  }
               }
            }
            const formData = new FormData();
            formData.append('commentaire',commentaire.value);
            formData.append('envoyerStudentCommentaire','envoyerStudentCommentaire')
            xhr.send(formData);
         }

         // alert('click sur button')
      }
   </script>
</body>

</html>