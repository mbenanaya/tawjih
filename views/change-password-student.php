<?php include('./controllers/session-student.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- <link href="./css/templatemo-kind-heart-charity.css" rel="stylesheet"> -->
    <!-- <link href="./views/assets/css/templatemo-kind-heart-charity.css" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>

    <title>Change password</title>
    <style>
        #error_incorrect {
            text-align: center;
            margin-bottom: -1rem;
            background-color: rgba(241, 37, 74, .8);
            border-radius: 15px;
            padding: 0.5rem 0;
            font-size: 1rem;
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

    <main id="main" class="main">
        <div class="container my-5">
            <div class="bg-white  px-3 mb-5 d-flex justify-content-md-between align-items-center">
                <div class="pagetitle pt-3">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL . "/dashboard-student" ?>">Home</a></li>
                            <li class="breadcrumb-item active">changer le mot de passe</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class='row'>
                <div class='col-md-12'>
                    <div class="card">
                        <!-- <div class="card-header" dir="rtl">
                     <h4 class='card-title'>تواصل معنا</h4>

                  </div> -->
                        <div class="card-header bg-light fs-4 text-dark"> changer le mot de passe
                        </div>
                        <p id="error_incorrect" style="display:none"></p>
                        <div class="card-body">                            
                            <form id="changePassword">
                                <input type="hidden" name="email_student" value="<?php echo $_SESSION['email_student'] ?>">
                                <input type="hidden" name="id_student" value="<?php echo $_SESSION['unique_id_student'] ?>">
                                <span id="error"></span>                                
                                <div class="row">                                    
                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <label class="text-dark mb-1" for="old_password">Ancien mot de passe</label>
                                        <input type="password" id="old_password" name="old_password" class="form-control border-primary" placeholder="ancien mot de passe">
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="text-danger" id="passwordValidationMessage"></span>
                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <label class="text-dark mb-1" for="new_password">Nouveau mot de passe :</label>
                                        <input type="password" id="new_password" name="new_password" class="form-control border-primary" placeholder="nouveau mot de passe">
                                    </div>
                                </div>
                                <div class="row">
                                    <span style="color:red" id="error_confirme"></span>
                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <label class="text-dark mb-1" for="confirme_new_password">Confirmer le mot de passe :</label>
                                        <input type="password" id="confirme_new_password" name="confirme_new_password" class="form-control border-primary" placeholder="Confirmer mot de passe">
                                    </div>
                                </div>
                                <div class='d-flex justify-content-start mt-3'>
                                    <input type="submit" name="changePasswordAccount" value="Changer" class="btn btn-primary px-3" />
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
        // check password
        $('#new_password').keyup(function() {
            var password = $(this).val();
            if (password.length >= 8) {
                $('#passwordValidationMessage').text(''); // Clear validation message if password is valid
            } else {
                $('#passwordValidationMessage').text('Le mot de passe doit comporter 8 caractères.');
            }
        });
        // on submit form contat...
        $('#changePassword').submit(function(e) {
            e.preventDefault();
            $("#error").hide();
            $("#error_confirme").hide();
            $('#passwordValidationMessage').hide();
            $("#error_incorrect").hide();
            //old_password required
            var old_password = $("input#old_password").val();
            if (old_password == "") {
                $("#error").fadeIn().text("* Ancien mot de passe est obligatoire").css('color', 'red');
                $("input#old_password").focus();
                return false;
            }
            //new_password required
            var new_password = $("input#new_password").val();
            if (new_password == "") {
                $("#error").fadeIn().text("* Nouveau mot de passe est obligatoire").css('color', 'red');
                $("input#new_password").focus();
                return false;
            }
            // check password
            var check_password = $('#new_password').val();
            if (check_password.length < 8) {
                $('#passwordValidationMessage').fadeIn().text('Le mot de passe doit comporter 8 caractères.');
                $("input#new_password").focus();
                return false;                                
            }
            //confirme_new_password required
            var confirme_new_password = $("input#confirme_new_password").val();
            if (confirme_new_password == "") {
                $("#error_confirme").fadeIn().text("* confirmer le mot de passe est obligatoire").css('color', 'red');
                $("input#confirme_new_password").focus();
                return false;
            }
            // check if password confirmed            
            if (!(confirme_new_password === new_password)) {
                $("#error_confirme").fadeIn().text("* confirmation du mot passe est incorrecte").css('color', 'red');
                $("input#confirme_new_password").focus();
                return false;
            }
            // ajax
            $.ajax({
                type: "post",
                url: "./controllers/ajax.php",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#error").hide();
                    $("#error_confirme").hide();
                    $('#passwordValidationMessage').hide();
                    $("#error_incorrect").hide();
                },
                success: function(data) {
                    console.log(data);
                    if (data.trim() == "password is change") {
                        Swal.fire({
                            icon: "success",
                            title: "Mot de passe changé avec success",                            
                        });
                        $("input#old_password").val('');
                        $('#new_password').val('');
                        $("input#confirme_new_password").val('');
                    } else if (data.trim() == "old password incorrect") {
                        $("#error_incorrect").fadeIn().text("Ancien mot de passe incorrecte").css('color', 'white');
                        $("input#old_password").focus();
                        $("input#old_password").val('');
                        $('#new_password').val('');
                        $("input#confirme_new_password").val('');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: "une erreur est survenue!",                            
                        })
                        $("input#old_password").val('');
                        $('#new_password').val('');
                        $("input#confirme_new_password").val('');
                    }
                }
            });
        });
        return false;
    })
</script>

</html>