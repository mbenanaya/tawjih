<?php
include('./controllers/session-admin.php');
require_once './controllers/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Ajouter article</title>
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

<body>

    <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
        <?php include('./views/assets/inlcudes/header-admin.php');  ?>
    </header>
    <aside id="sidebar" class="sidebar">
        <?php include('./views/assets/inlcudes/sidebar-admin.php'); ?>
    </aside>

    <!-- MAIN -->
    <main id="main" class="main">

        <div class="container my-5">

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-5 d-flex align-items-center">
                <!-- <h1>Dashboard</h1> -->
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./dashboard-admin">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                <h2 class="h5 mb-3 mb-lg-0"><a href="./dashboard-admin" class="text-muted" style="margin-right: 5px;"><i class="bi bi-arrow-left-square me-2"></i></a> Retour</h2>

            </div>

            <!-- CHAT BOX -->
            <div class="container-fluid">

                <div class="container">
                    <!-- Title -->


                    <!-- Main content -->
                    <div class="row">
                        <!-- Left side -->
                        <div class="col-lg-12">
                            <!-- Basic information -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="h6 mb-4">Basic information</h3>
                                    <form action="#" method="POST" id="form1" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Titre :</label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="titre de article">
                                                    <span class="title-error"></span>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Titre De Concours :</label>
                                                    <input type="text" class="form-control" name="titre" id="titre" placeholder="titre de concours">
                                                    <span class="titre-concours-error"></span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Lien de l'ècole :</label>
                                                    <input type="text" class="form-control" id="lien-ecole" name="lien-ecole" placeholder="lien d'ècole">
                                                    <span class="lien-ecole-error"></span>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Lien De Vidèo :</label>
                                                    <input type="text" class="form-control" id="lien-video" name="lien-video" placeholder="lien de vidèo">
                                                    <span class="lien-video-error"></span>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                            
                                                <label class="form-label">Date De Concours :</label>
                                                    <input type="date" class="form-control" id="temps_restant" name="temps_restant">
                                            
                                                    <span class="temps-restant-error"></span>

                                                
                                                </div>
                                            </div>

                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- Right side -->
                        <div class="col-lg-13">
                            <!-- Avatar -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="h6">Image :</h3>
                                    <div class="input-group">

                                        <input type="file" class="form-control" id="image" name="image" accept="image/jpeg, image/png, image/gif">

                                        <span class="input-group-text">                                        
                                            <i class="fas fa-image"></i>                                            
                                        </span>                                        
                                    </div>
                                    <span class="image-error"></span>
                                </div>
                                <div class="card-body">
                                    <h3 class="h6">Pdf :</h3>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">

                                        <span class="input-group-text">
                                            <i class="fas fa-file-pdf"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="h6">Audio :</h3>
                                    <div class="input-group">

                                        <input type="file" class="form-control" id="audio" name="audio" accept="audio/*">

                                        <span class="input-group-text">
                                            <i class="fas fa-music"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h3 class="h6">Video :</h3>
                                    <div class="input-group">

                                        <input  class="form-control" type="file" id="video" name="video">

                                        <span class="input-group-text">
                                            <i class="fas fa-video"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- Notes -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h3 class="h6">Description :</h3>
                                        <textarea id="summernote" name="des"></textarea>

                                    </div>
                                </div>
                                <!-- Notification settings -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h3 class="h6">Les Types De Bacs :</h3>

                                        <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="select-all">
                                                <label class="form-check-label" for="select-all">
                                                    Sélectionner tous les bacs
                                                </label>
                                            </div>
                                            

                                        <div class="checkbox-list">

                                            <?php
                                            $auth = new Auth();
                                            $bacs = $auth->Showbac();
                                            foreach ($bacs as $bac) {
                                            ?>
                                                <div class="form-check">
                                                    <input class="form-check-input bacs" type="checkbox" id="bac-<?php echo $bac['idBac']; ?>" value="<?= $bac['idBac'] ?>" name="bacs[]">
                                                    <label class="form-check-label" for="bac-<?php echo $bac['idBac']; ?>">
                                                        <?php echo $bac['sector']; ?>
                                                    </label>
                                                </div>
                                            <?php
                                            }
                                            ?>     
                                            <span class="bacsCheck_erreur"></span>                                       
                                          
                                            

                                            <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                                                <h2 class="h5 mb-3 mb-lg-0"><a href="" class="text-muted"></a> </h2>
                                                <div class="hstack gap-3">
                                                    <button type="submit" class="btn btn-primary btn-sm btn-icon-text" name="ajouter" style="font-size: 22px;"><i class="bi bi-save"></i> <span class="text">Save</span></button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>

    </main>
    <script>
        // Récupérer la checkbox "select-all"
        const selectAllCheckbox = document.getElementById("select-all");
        // Récupérer tous les checkboxes
        const checkboxes = document.querySelectorAll('input[type=checkbox][name="bacs[]"]');
        // Ajouter un événement "change" à la checkbox "select-all"
        selectAllCheckbox.addEventListener("change", function() {
            // Parcourir tous les checkboxes
            checkboxes.forEach(function(checkbox) {
                // Cocher ou décocher le checkbox en fonction de l'état de la checkbox "select-all"
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js" integrity="sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_ar.min.js" integrity="sha512-nb2K94mYysmXkqlnVuBdOagDjQ2brfrCFIbfDIwFPosVjrIisaeYDxPvvr7fsuPuDpqII0fwA51IiEO6GulyHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js" integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <!-- MAIN FOR DASHBOARD -->
    <script src="./views/assets/js/main.js"></script>
    <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // Hauteur de l'éditeur
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ] // Configuration de la barre d'outils
            });            
            $("#form1").submit(function(e) {
                e.preventDefault();
                var title = $("#title").val();
                var image = $("#image").val();
                var titre_concours = $("#titre").val();
                var temps_restant = $("#temps_restant").val();
                var lien_ecole = $("#lien-ecole").val();
                var lien_video= $("#lien-video").val();

                // Ajouter ici des validations pour chaque champ            
                var isValid = true; 
                var checkedBac = false;               
                for(var i=0;i<$(".bacs").length;i++){                    
                    if($(".bacs")[i].checked === true){
                        checkedBac = true;                        
                    }
                }                
                if (checkedBac === false) {
                    $(".bacsCheck_erreur").text("seléctionne de bac est obligatoire").addClass('text-danger');                    
                    isValid = false;
                } else {
                    $(".image-error").text("");
                }

                if (image.trim() === "") {
                    $(".image-error").text("Image est obligatoire").addClass('text-danger');
                    $("#image").focus();
                    isValid = false;
                } else {
                    $(".image-error").text("");
                }
                if (temps_restant.trim() === "") {
                    $(".temps-restant-error").text("Date concours est obligatoire").addClass('text-danger');
                    $("#temps_restant").focus();
                    isValid = false;
                } else {
                    $(".temps-restant-error").text("");
                }
                if (lien_video.trim() === "") {
                    $(".lien-video-error").text("Lien de video est obligatoire").addClass('text-danger');
                    $("#lien-video").focus();
                    isValid = false;
                } else {
                    $(".lien-video-error").text("");
                }  
                if (lien_ecole.trim() === "") {
                    $(".lien-ecole-error").text("Lien de l'école est obligatoire").addClass('text-danger');
                    $("#lien-ecole").focus();
                    isValid = false;
                } else {
                    $(".lien-ecole-error").text("");
                } 
                if (titre_concours.trim() === "") {
                    $(".titre-concours-error").text("Titre du concours est obligatoire").addClass('text-danger');
                    $("#titre").focus();
                    isValid = false;
                } else {
                    $(".titre-concours-error").text("");
                }                
                if (title.trim() === "") {
                    $(".title-error").text("Titre est obligatoire").addClass('text-danger');
                    $("#title").focus();
                    isValid = false;
                } else {
                    $(".title-error").text("");
                }
                    
                // Supprimer le message d'erreur lorsque l'utilisateur commence à saisir dans l'input correspondant
                $("#title").on("input", function() {
                    if ($(this).val().trim() !== "") {
                        $(".title-error").text("");
                    }
                });

                $("#image").on("input", function() {
                    if ($(this).val().trim() !== "") {
                        $(".image-error").text("");
                    }
                });

                $("#titre").on("input", function() {
                    if ($(this).val().trim() !== "") {
                        $(".titre-concours-error").text("");
                    }
                });

                $("#temps_restant").on("input", function() {
                    if ($(this).val().trim() !== "") {
                        $(".temps-restant-error").text("");
                    }
                });

                $("#lien-ecole").on("input", function() {
                    if ($(this).val().trim() !== "") {
                        $(".lien-ecole-error").text("");
                    }
                });
                $("#lien-video").on("input", function() {
                    if ($(this).val().trim() !== "") {
                        $(".lien-video-error").text("");
                    }
                });
                if(checkedBac == true){
                    $(".bacsCheck_erreur").text("");
                }
                console.log(typeof $);


                if(isValid) {
                    $.ajax({
                        url: './controllers/process.php',
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: new FormData(this),
                        success: function(response) {
                            $("#summernote").val("");
                            $("#form1")[0].reset();
                            console.log(response);
                            if ($.trim(response) == 'login') {
                                console.log(response);
                                Swal.fire({
                                    title: 'Article ajouté avec succès !',
                                    type: 'success'
                                });
                            } else {
                                console.log(response);
                                Swal.fire({
                                    title: 'Une erreur est survenue !',
                                    text: 'Veuillez réessayer plus tard.',
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },

                    });
                }

            });

        });
    </script>

</body>

</html>