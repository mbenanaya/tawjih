<?php include('./controllers/session-student.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>

   <!-- <link href="./css/templatemo-kind-heart-charity.css" rel="stylesheet"> -->
   <!-- <link href="./views/assets/css/templatemo-kind-heart-charity.css" rel="stylesheet"> -->

   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>

   <title>Contact Student</title>
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

   <main id="main" class="main">
      <div class="container my-5">
         <div class="bg-white  px-3 mb-5 d-flex justify-content-md-between align-items-center">
            <div class="pagetitle pt-3">
               <nav>
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo BASE_URL . "/dashboard-student" ?>">Home</a></li>
                     <li class="breadcrumb-item active">Contact</li>
                  </ol>
               </nav>
            </div>
            <div>
               <!-- <h4 class='align-right my-0' style='text-align: right;'>فيديوهات توجيه نت</h4>
            <p class='my-0 fs-sm-3' style='text-align: right;'>انتاجات وفيديويهات توضيحة وشروحات في موقع توجيه</p> -->
            </div>
         </div>

         <div class='row'>
            <div class='col-md-12'>
               <div class="card">
                  <!-- <div class="card-header" dir="rtl">
                     <h4 class='card-title'>تواصل معنا</h4>

                  </div> -->
                  <div class="card-header bg-light fs-4 text-dark" dir="rtl"> تواصل معنا
                  </div>
                  <div class="card-body">
                     <form id="contact">
                        <div class="row mt-3">
                        <p id="error_contact" style="display: none">error</p>
                           <div class="col-12 col-md-6 col-lg-6 mb-3" dir="rtl">
                              <label class="text-dark mb-1 text-end d-block" for="inputLastNameArab"> النسب</label>
                              <input class="form-control border-primary" id="last-name" type="text" value="" placeholder='النسب'>
                           </div>
                           <div class="col-lg-6 col-md-6 col-12 mb-3" dir="rtl">
                              <label class="text-dark mb-1 text-end d-block" for="inputLastNameArab">الإسم</label>
                              <input type="text" name="first-name" id="first-name" class="form-control border-primary" placeholder="الإسم" required>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 col-md-12" dir="rtl">
                              <label class="text-dark mb-1 text-end d-block" for="inputLastNameArab"> البريد الالكتروني</label>
                              <input type="email" name="email" id="email_contact" pattern="[^ @]*@[^ @]*" class="form-control border-primary" placeholder="البريد الالكتروني" required>
                           </div>
                           <div class="col-md-12 mt-3" dir="rtl">
                              <label class="small mb-1 text-end d-block" for="inputLastNameArab">كيف يمكن مساعدتك</label>
                              <textarea name="message" rows="5" id="message" class="form-control border-primary" placeholder="كيف يمكن مساعدتك"></textarea>
                           </div>
                        </div>
                        <div class='d-flex justify-content-end mt-3'>
                           <button type="submit" class="btn btn-primary px-3" name='sub'>إرسل
                              رسالة</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

         <!-- start  CHAT AREAT FOR STUDENT -->
         <?php include('./views/chat.php'); ?>
         <!--end  CHAT AREAT FOR STUDENT -->
      </div>
   </main>
   <!-- start scripts  -->
   <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <!-- script-dashboard-student  -->
   <?php include('./views/assets/inlcudes/script-dashboard-student.php'); ?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function($) {      
      // on submit form contat...
      $('#contact').submit(function(e) {
         e.preventDefault();
         $("#error_contact").hide();
         //first-name required
         var first_name = $("input#first-name").val();
         if (first_name == "") {
            $("#error_contact").fadeIn().text("* first name required").css('color', 'red');
            $("input#first-name").focus();
            return false;
         }
         //last-name required
         var last_name = $("input#last-name").val();
         if (last_name == "") {
            $("#error_contact").fadeIn().text("* last name required").css('color', 'red');
            $("input#last-name").focus();
            return false;
         }
         //email required
         var email = $("input#email_contact").val();
         if (email == "") {
            $("#error_contact").fadeIn().text("* email required").css('color', 'red');
            $("input#email_contact").focus();
            return false;
         }
         // password required
         var message = $("#message").val();
         if (message == "") {
            $("#error_contact").fadeIn().text("* message required").css('color', 'red');
            $("#message").focus();
            return false;
         }

         // ajax
         $.ajax({
            type: "GET",
            url: "./controllers/ajax.php",
            data: {
               email_contact: $("#email_contact").val(),
               message: $("#message").val(),
               first_name: $("#first-name").val(),
               last_name: $("#last-name").val()
            },
            success: function(data) {
               console.log(data);
               if (data.trim() == "Message email contact has been sent") {
                  Swal.fire({                    
                     width:"700px", 
                     html : `
                        <head>                       
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />
                        <link rel='stylesheet' href='	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'>                        
                     </head>
                     <style>                       
                        .mail-seccess {                          
                           background: #fff;
                           border-top: 1px solid #eee;
                        }

                        .mail-seccess .success-inner {
                           display: inline-block;
                        }

                        .mail-seccess .success-inner h1 {
                           font-size: 80px;
                           text-shadow: 3px 5px 2px #3333;
                           color: #006DFE;
                           font-weight: 700;
                        }

                        .mail-seccess .success-inner h1 span {
                           display: block;
                           font-size: 20px;
                           color: #333;
                           font-weight: 600;
                           text-shadow: none;
                           margin-top: 20px;
                        }

                        .mail-seccess .success-inner p {
                           padding: 20px 15px;
                        }

                        .mail-seccess .success-inner .btn {
                           color: #fff;
                        }
                     </style>

                     <body>
                        <section class='mail-seccess section'>
                           <div class='container'>
                                 <div class='row'>
                                    <div class='col-lg-6 offset-lg-3 col-12'>                                       
                                       <!-- Error Inner -->
                                       <div class='success-inner'>
                                             <h1><i class='fa fa-envelope'></i><span>Votre e-mail envoyé avec succès !</span></h1>
                                             <h1><span>!تم إرسال بريدك الإلكتروني بنجاح </span></h1>
                                             <p dir='rtl'> تم استلام رسالتكم، شكرًا على التواصل معنا. نود إعلامكم بأننا سنقوم بالرد عليكم في  اقرب وقت.</p>                                             
                                       </div>                                       
                                    </div>
                                 </div>
                           </div>
                        </section>
                     </body>`
                  });
                  $('#contact')[0].reset();
               } else {
                  Swal.fire({
                     icon: 'error',
                     title: "!! حدث خطأ ",
                     text: "  .تعذر إرسال الرسالة إلى بريدك الإلكتروني \n, حاول مرة أخرى",
                  })
               }
            }
         });
      });
      return false;
   })
</script>

</html>