<?php
include('./controllers/SessionResponsable.php');
require_once './controllers/auth.php';





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png"
    type="image/x-icon">

    <!-- FONTAESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--  -->
    <title>students</title>
    <link rel="stylesheet" href="./views/assets/css/style.css">
    <link rel="stylesheet" href="./views/assets/css/chatbox_style.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Open+Sans:wght@300;400;600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Maven Pro', sans-serif;
        }

        .export-container {
  float: right;
  margin-right: 20px;
}

.export-text {
  display: inline-block;
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

.export-button {
  display: inline-block;
  background-color: green;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.export-button:hover {
  background-color: #005D75;
}

    </style>




</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
        <?php include('./views/assets/inlcudes/header-responsable.php');  ?>
    </header>
    <aside id="sidebar" class="sidebar">
        <?php include('./views/assets/inlcudes/sidebar-responsable.php'); ?>
    </aside>

    <!-- MAIN -->


    <main id="main" class="main">

        <div class="export-container">
            <span class="export-text">Export to Excel:</span>
            <a href="views/export_students_reponsable.php" class="export-button">Export</a>
        </div>



        <div class="container my-5">
            <div class="card border-primary">
                <h5 class="card-header bg-primary d-flex justify-content-between">
                    <span class="text-light lead align-self-center">All Students</span>

                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;ADD new Student</a>
                </h5>
                <div class="card-body">
                    <div class="table-responsive" id="showNote">
                        <p class="text-center lead mt-5">Please Wait ...</p>



                    </div>
                </div>

                <!--Add new Model note Modal -->
                <div class="modal fade" id="addNoteModal">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h4 class="modal-title">Add New Student</h4>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="add-note-form" class="px-3" enctype="multipart/form-data">
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="codeMassar">Code Massar</label>
                                            <input type="text" id="codeMassar" name="codeMassar" class="form-control form-control-lg rounded-0" placeholder="Enter code Massar" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cin">CIN</label>
                                            <input type="text" id="cin" name="cin" class="form-control form-control-lg rounded-0" placeholder="Enter CIN" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg rounded-0" placeholder="Enter email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">

                                        <div class="col-md-6">
                                            <label for="firstName">First Name</label>
                                            <input type="text" id="firstName" name="firstName" class="form-control form-control-lg rounded-0" placeholder="Enter first name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" id="lastName" name="lastName" class="form-control form-control-lg rounded-0" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">

                                        <div class="col-md-6">
                                            <label for="firstNameArabe">First Name (Arabic)</label>
                                            <input type="text" id="firstNameArabe" name="firstNameArabe" class="form-control form-control-lg rounded-0" placeholder="Enter first name (Arabic)" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastNameArabe">Last Name (Arabic)</label>
                                            <input type="text" id="lastNameArabe" name="lastNameArabe" class="form-control form-control-lg rounded-0" placeholder="Enter last name (Arabic)" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="photo">Photo</label>
                                            <input type="file" id="photo" name="photo" class="form-control form-control-lg rounded-0" placeholder="Enter Photo" accept="image/jpeg, image/png, image/gif">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sex">Sex</label>
                                            <input type="text" id="sex" name="sex" class="form-control form-control-lg rounded-0" placeholder="Enter sex" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="photo">bacyear</label>
                                            <input type="text" id="bacyear" name="bacyear" class="form-control form-control-lg rounded-0" placeholder="Enter bac year" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="select-lycee" class="form-label">Lycee:</label>
                                            <select class="form-select" id="select-lycee" name="lycee">
                                                <option value="">Sélectionnez lycee</option>
                                                <?php
                                                $auth = new Auth(); // Instanciation de la classe Auth
                                                $lycees = $auth->Lycee(); // Récupérer les types de bacs
                                                foreach ($lycees as $lycee) {
                                                    echo '<option value="' . $lycee['idLycee'] . '">' . $lycee['nameAr'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="lastNameArabe">telephone</label>
                                            <input type="text" id="telephone" name="telephone" class="form-control form-control-lg rounded-0" placeholder="Enter telephone" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastNameArabe">telephone parent</label>
                                            <input type="text" id="telephonep" name="telephonep" class="form-control form-control-lg rounded-0" placeholder="Enter telephone parent" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="lastNameArabe">Adresse</label>
                                            <input type="text" id="adresse" name="adresse" class="form-control form-control-lg rounded-0" placeholder="Enter Adresse" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastNameArabe">place bithday</label>
                                            <input type="text" id="place" name="place" class="form-control form-control-lg rounded-0" placeholder="Enter place de naissance" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="select-region">Région :</label>
                                            <select class="form-select" id="select-region" name="region">
                                                <option value="">Sélectionner une région</option>
                                                <?php
                                                $auth = new Auth();
                                                $regs = $auth->Region();
                                                foreach ($regs as $reg) {
                                                    echo '<option value="' . $reg['idRegion'] . '">' . $reg['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="select-ville">Ville :</label>
                                            <select class="form-select" id="select-ville" name="ville">
                                                <option value="">Sélectionner une ville</option>
                                                <?php
                                                $auth = new Auth(); // Instanciation de la classe Auth
                                                $villes = $auth->Ville(); // Récupérer les villes
                                                foreach ($villes as $ville) {
                                                    echo '<option value="' . $ville['idCity'] . '">' . $ville['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="lastNameArabe">Date birthday</label>
                                            <input type="date" id="dateb" name="dateb" class="form-control form-control-lg rounded-0" placeholder="Enter date de naissance" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="select-bac" class="form-label">Types de Bac :</label>
                                            <select class="form-select" id="select-bac" name="bac">
                                                <option value="">Sélectionnez un type de bac</option>
                                                <?php
                                                $auth = new Auth(); // Instanciation de la classe Auth
                                                $bacs = $auth->Bac(); // Récupérer les types de bacs
                                                foreach ($bacs as $bac) {
                                                    echo '<option value="' . $bac['idBac'] . '">' . $bac['sector'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="select-bac" class="form-label">Pack :</label>
                                            <select class="form-select" id="select-pack" name="pack" required>
                                                <option value="" disabled selected>Sélectionnez un pack</option>
                                                <?php
                                                $auth = new Auth(); // Instanciation de la classe Auth
                                                $packs = $auth->Pack(); // Récupérer les types de bacs
                                                foreach ($packs as $pack) {
                                                    echo '<option value="' . $pack['idPack'] . '">' . $pack['domaineP'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="select-bac" class="form-label">Responsables :</label>
                                            <select class="form-select" id="select-responsable" name="responsable" required>
                                                <option value="" disabled selected>Sélectionnez un responsable</option>
                                                <?php
                                                $auth = new Auth(); // Instanciation de la classe Auth
                                                $Responsables = $auth->Responsables(); // Récupérer les types de bacs
                                                foreach ($Responsables as $responsable) {
                                                    echo '<option value="' . $responsable['idRes'] . '">' . $responsable['nomRes'] ." " .$responsable['prenomRes']. '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <input type="submit" name="addNote" id="addNoteBtn" value="Ajouter" class="btn btn-success btn-block btn-lg">




                                </form>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>


        </div>

    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>



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


    <!-- MAIN FOR DASHBOARD -->
    <script src="./views/assets/js/main.js"></script>
    <?php include('./views/assets/inlcudes/script-dashboard-responsable.php'); ?>

    <!-- FILE AJAX FOR CHATBOX -->
    <script src="./ajax/student/chatbox.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>




    <script>
        $(document).ready(function() {
            $('table').DataTable();
            // Add New Note Ajax Request
            $("#addNoteBtn").click(function(e) {
                if ($('#add-note-form')[0].checkValidity()) {
                    e.preventDefault();
                    $("#addNoteBtn").val("Please Wait ...");
                    $.ajax({
                        url: 'controllers/process.php',
                        method: 'post',
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: new FormData($('#add-note-form')[0]),
                        success: function(response) {
                            $("#addNoteBtn").val("Ajouter");
                            $("#add-note-form")[0].reset();
                            $("#addNoteModal").modal('hide');
                            Swal.fire({
                                title: 'note added successfully !',
                                type: 'success'
                            });
                            displayAllNotes();
                        }
                    });
                }
            });
            $("body").on("click", ".excel", function(e) {
                e.preventDefault();
                var formData = $('form').serialize();
                $.ajax({
                    type: 'POST',
                    url: 'controllers/process.php',
                    data: formData,
                    success: function(data) {

                    }
                });

            })


            $("body").on("click", ".deleteBtn", function(e) {
                e.preventDefault();
                var del_id = $(this).attr("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'controllers/process.php',
                            method: 'post',
                            data: {
                                del_id: del_id
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Note Deleted Successufly !',
                                    'success'
                                )
                                displayAllNotes();
                            }
                        });

                    }
                });
            });
            // info
            $("body").on("click", ".infoBtn", function(e) {
                e.preventDefault();
                var info_id = $(this).attr('id');
                $.ajax({
                    url: 'controllers/process.php',
                    method: 'post',
                    data: {
                        info_id: info_id
                    },
                    success: function(response) {
                        console.log(response);
                        try {
                            var data = JSON.parse(response);
                            Swal.fire({
                                title: 'Student Information',
                                html: '<table class="table">' +
                                    '<tr><td><strong>Code Massar:</strong></td><td>' + data.codeMassar + '</td></tr>' +
                                    '<tr><td><strong>CIN:</strong></td><td>' + data.cin + '</td></tr>' +
                                    '<tr><td><strong>Last Name:</strong></td><td>' + data.lastName + '</td></tr>' +
                                    '<tr><td><strong>First Name:</strong></td><td>' + data.firstName + '</td></tr>' +
                                    '<tr><td><strong>Email :</strong></td><td>' + data.email + '</td></tr>' +
                                    '<tr><td><strong> sex:</strong></td><td>' + data.sex + '</td></tr>' +
                                    '<tr><td><strong> Annè Bac:</strong></td><td>' + data.bacYear + '</td></tr>' +
                                    '<tr><td><strong> Phone:</strong></td><td>' + data.phone + '</td></tr>' +
                                    '<tr><td><strong> Phone Famille:</strong></td><td>' + data.parentPhone + '</td></tr>' +
                                    '<tr><td><strong> adresse:</strong></td><td>' + data.address + '</td></tr>' +
                                    '<tr><td><strong> lieu de naissance:</strong></td><td>' + data.placeBirth + '</td></tr>' +
                                    '<tr><td><strong> date de naissance:</strong></td><td>' + data.dateBirth + '</td></tr>' +
                                    '</table>',
                                type: 'info',
                                showCloseButton: true,
                                customClass: {
                                    table: 'table-striped'
                                }
                            })
                        } catch (e) {
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred while processing the request.',
                                type: 'error',
                                showCloseButton: true,
                            })
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });
            $("body").on("click", ".activer", function(e) {
                e.preventDefault();
                var codeMassar = $(this).attr("id");
                var checkbox = $(this).find('input[type="checkbox"]');
                var statut = $(this).val();
                Swal.fire({
                    title: 'Êtes-vous sûr(e) ?',
                    text: "le compte d'etudiant sera désactivé !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, activer !'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'controllers/process.php',
                            method: 'post',
                            data: {
                                changeStatut : 'changeStatut',
                                codeMassar: codeMassar,
                                statut:statut
                            },
                            success: function(response) {
                                console.log(response);
                                if($.trim(response) == "change"){
                                    displayAllNotes();
                                    Swal.fire(
                                        'Activé(e)!',
                                        'Le champ a été activé avec succès !',
                                        'success'
                                    );
                                }else{
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'une erreur survenue',
                                        type: 'error',
                                        showCloseButton: true,
                                     })
                                }                             
                                // Mettre la case à cocher dans l'état "coché"
                            }
                        });
                    }
                });
            });


            var factureWindows = {};

            $("body").on("click", ".facture", function() {
                var id = $(this).attr('id');
                var windowName = "Facture_" + id;
                if (factureWindows[windowName] && !factureWindows[windowName].closed) {
                    factureWindows[windowName].focus();
                } else {
                    factureWindows[windowName] = window.open("", windowName, "width=800,height=600");
                    $.ajax({
                        url: "controllers/imprimer.php",
                        method: "post",
                        data: {
                            action: "get_student_info",
                            id: id
                        },
                        success: function(response) {
                            response = response.replace(/false/g, '');
                            factureWindows[windowName].document.open();
                            factureWindows[windowName].document.write(response);
                            factureWindows[windowName].document.close();
                        }
                    });
                }
            });

            /* $("body").on("click", ".facture", function() {
                var id = $(this).attr('id');
                $.ajax({
                    url: "controllers/process.php",
                    method: "post",
                    data: {
                        action: "get_student_info",
                        id: id
                    },
                    success: function(response) {
                        // Remove the word "false" from the response
                        response = response.replace(/false/g, '');
                        var newWindow = window.open("", "Facture", "width=800,height=600");
                        newWindow.document.write("<html><head><title>Détails de l'étudiant</title></head><body>");
                        newWindow.document.write(response);
                        newWindow.document.write("<button onclick='window.print()'>Imprihmer</button>");
                        newWindow.document.write("</body></html>");
                        newWindow.document.close();
                    }
                });
            });
             */







            displayAllNotes();

            function displayAllNotes() {
                $.ajax({
                    url: 'controllers/process.php',
                    method: 'post',
                    data: {
                        action: 'display_notes_responsables'
                    },
                    success: function(response) {
                        //console.log(response);
                        $("#showNote").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                })

            }
        });
    </script>



</body>

</html>