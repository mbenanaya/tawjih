<?php include('./controllers/SessionResponsable.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Add-établissement</title>
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
        <?php include('./views/assets/inlcudes/header-responsable.php');  ?>
    </header>
    <!-- end header  -->
    <!-- start sidebar  -->
    <aside id="sidebar" class="sidebar">
        <?php include('./views/assets/inlcudes/sidebar-responsable.php'); ?>
    </aside>
    <!-- end  sidebar  -->
    <!-- MAIN -->
    <main id="main" class="main">

        <div class="container my-3">

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-responsable">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/crud-establishment-resp">établissement</a></li>
                        <li class="breadcrumb-item active">Ajouter</li>
                    </ol>
                </nav>
            </div>

            <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show" id='messageError'>
                <span><i class="mdi mdi-check"></i></span>
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div>
            <form id='formEstablishment'>
                <!-- strat profile -->
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card">
                            <div class="card-header bg-light  text-dark"> Ajouter une établissement
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class='col-md-6 col-12'>
                                        <div class='card' id="file">
                                            <divn class="card-body">
                                                <h5>Logo :</h5>
                                                <div class="form">                                                    
                                                    <div class="form-row">
                                                        <input class="file-input" type="file" name="logo" id="image-input" accept="image/jpeg, image/png, image/gif" hidden>
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        <p class="text-center">sélectionner un logo <br>Uniquement JPEG, PNG, et GIF</p>                                                        
                                                    </div>                                                    
                                                </div>
                                                <p class="text-center mt-0" id="error_file" style="display: none">error</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 card">
                                        <img class="img-fluid" id="image-preview" src="" alt="" style="max-height: 260px;">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-md-6 col-lg-6 mb-3">
                                        <label class="text-dark mb-1" for="inputLastNameArab">Libellé :</label>
                                        <input class="form-control border-primary" name='libelle' id="libelle" type="text" placeholder='Libellé'>
                                        <span id="error_libelle" style="display: none">error</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <label class="text-dark mb-1" for="inputLastNameArab">dernier délai pour l'inscription :</label>
                                        <input type="date" name="last_deadline" id="last_deadline" class="form-control border-primary" placeholder="dernier délai" required>
                                        <span id="error_last_deadline" style="display: none">error</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <label class="text-dark mb-1" for="inputLastNameArab"> Filiéres :</label>
                                        <input type="text" name="Filieres" id="Filieres" class="form-control border-primary" placeholder="Filiéres" required>
                                        <span id="error_Filieres" style="display: none">error</span>
                                    </div>
                                </div>
                            </div>
                            <div class="btns mb-3 float-end text-center">
                                <button type="submit" class="btn btn-success text-white px-4" style="font-weight: bolder" id='btnSaveChange'>Ajouter</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <!--end upload photo -->

        </div>

    </main>

    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>    

    <!-- script-dashboard-student  -->
    <?php include('./views/assets/inlcudes/script-dashboard-responsable.php'); ?>

    <!-- JavaScript sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // When the input file changes
            $('#image-input').change(function() {
                var file = this.files[0];
                var fileType = file.type.toLowerCase();

                if (fileType === 'image/jpeg' || fileType === 'image/jpg' || fileType === 'image/png' || fileType === 'image/gif') {
                    // File type is valid
                    console.log('Valid file type');
                    // Additional code to process the file can be added here
                } else {
                    // File type is invalid
                    console.log('Invalid file type');
                    $("#error_file").fadeIn().text("Type de fichier invalide !!").css('color', 'red');
                    // Reset the file input field to clear the selection
                    $(this).val('');
                }

                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Update the source of the image preview
                        $('#image-preview').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });

            // add new Establishment
            $('#formEstablishment').submit(function(e) {
                e.preventDefault();
                var file = $("input#image-input").val();
                if (file == '') {
                    $("#error_file").fadeIn().text("Aucun fichier sélectionné !!").css('color', 'red');
                    $("input#file-input").focus();
                    return false;
                }
                var libelle = $("input#libelle").val();
                if (libelle == '') {
                    $("#error_libelle").fadeIn().text("Champ obligatoire !!").css('color', 'red');
                    $("input#libelle").focus();
                    return false;
                }
                var last_deadline = $("input#last_deadline").val();
                if (last_deadline == '') {
                    $("#error_last_deadline").fadeIn().text("Champ obligatoire !!").css('color', 'red');
                    $("input#last_deadline").focus();
                    return false;
                }
                var Filieres = $("input#Filieres").val();
                if (Filieres == '') {
                    $("#error_Filieres").fadeIn().text("Champ obligatoire !!").css('color', 'red');
                    $("input#Filieres").focus();
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: "./controllers/crud-controller.php",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    //beforeSend : function(){},
                    success: function(response) {
                        console.log(response);
                        if ($.trim(response) == "added") {
                            Swal.fire({
                                //position: 'top-end',
                                icon: 'success',
                                title: 'établisments a été ajouté avec success',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            $('#formEstablishment')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Une erreur est survenue',
                                text: 'Veuillez réessayer',
                                showConfirmButton: true,
                            })
                        }

                    }
                })
            })
        });
    </script>

</body>

</html>