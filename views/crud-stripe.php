<?php
include('./controllers/session-admin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Setting | stripe</title>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
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

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-admin">Home</a></li>
                        <li class="breadcrumb-item active">Stripe payment</li>
                    </ol>
                </nav>
            </div>
            <form id="formStripe">
                <!-- strat profile -->
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card">
                            <div class="card-header bg-light  text-dark"> Mettre à jour les clés de Stripe</div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id_stripe" id="id_stripe" value="0">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <p id="error_publishable_key" style="display:none">error</p>
                                        <label class="text-dark mb-1" for="publishable_key"><b>Publishable key</b></label>
                                        <input type="text" name='publishable_key"' id="publishable_key" class="form-control border-primary" placeholder="Publishable key">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <p id="error_secret_key" style="display:none">error</p>
                                        <label class="text-dark mb-1" for="secret_key"><b>Secret key</b></label>
                                        <input type="text" class="form-control border-primary" id="secret_key" name='secret_key' placeholder='Secret key'>
                                    </div>
                                </div>
                                <br>

                                <div class="row mt-3">
                                    <div class="btns mb-3 float-end">
                                        <input type="submit" class="btn btn-primary text-white px-4" style="font-weight: bolder" name='btnSaveChangeStripe' value="ENREGISTRER" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
    <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
    <!-- end scripts  -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function($) {
        // get data from database :
        function displayDataStripe() {
            $.ajax({
                type: "post",
                url: "./controllers/crud-controller.php",
                data: {
                    stripeUpdate: "requestDataStripe"
                },
                dataType: "json",
                success: function(res) {
                    console.log(res)  
                    if(res.resultat == 'stripe empty')                                                            {
                        console.log(res.resultat)  
                    }else if(res.resultat == 'stripe full'){
                        $("#id_stripe").val(res.stripeDtata['id']);
                        $("#publishable_key").val(res.stripeDtata['publishable_key']);
                        $("#secret_key").val(res.stripeDtata['secret_key']);
                    }
                }
            });
        }
        displayDataStripe();

        // on submit form ...
        $('#formStripe').submit(function(e) {
            e.preventDefault();
            $("#error_secret_key").hide();
            $("#error_publishable_key").hide();
            //required
            var publishable_key = $("input#publishable_key").val();
            if (publishable_key == "") {
                $("#error_publishable_key").fadeIn().text("* Publishable key required").css('color', 'red');
                $("input#publishable_key").focus();
                return false;
            }
            //required
            var secret_key = $("input#secret_key").val();
            if (secret_key == "") {
                $("#error_secret_key").fadeIn().text("* Secret key required").css('color', 'red');
                $("input#secret_key").focus();
                return false;
            }
            // ajax
            $.ajax({
                type: "POST",
                url: "./controllers/crud-controller.php",
                data: {
                    id_stripe : $("#id_stripe").val(),
                    publishable_key : $("#publishable_key").val(),
                    secret_key : $("#secret_key").val()   
                },                
                beforeSend: function() {
                    $("#error_secret_key").hide();
                    $("#error_publishable_key").hide();
                },
                success: function(data) {
                    console.log(data);
                    if (data.trim() == "stripe updated") {
                        Swal.fire({
                            icon: "success",
                            title: "Stripe a été mis à jour avec succès",
                        });
                        displayDataStripe();
                    } else if (data.trim() == "stripe not updated") {
                        Swal.fire({
                            icon: 'error',
                            title: "une erreur est survenue!",
                            text: "Les clés de Stripe ne sont pas mises à jour"
                        })  
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: "une erreur est survenue!",
                        })                        
                    }
                }
            });
        });
        return false;
    });
</script>


</html>