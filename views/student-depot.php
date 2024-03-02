<?php
include('./controllers/session-admin.php');
require_once './controllers/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">

    <!-- FONTAESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--  -->
    <title>depot | Admin</title>
    <link rel="stylesheet" href="./views/assets/css/style.css">
    <link rel="stylesheet" href="./views/assets/css/chatbox_style.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Open+Sans:wght@300;400;600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Maven Pro', sans-serif;
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


    <main id="main" class="main pt-1">
        <div class="container my-5">
            <div class="card border-primary">
                <h5 class="card-header bg-primary d-flex justify-content-between">
                    <span class="text-light lead align-self-center">tous les étudiants ont un pack spécial</span>
                </h5>
                <div class="card-body">                   
                    <h5>cliquez sur <span class="text-danger">inscrire au l'établissements</span> pour ajouter un reçus d'inscription dans les établissements.</h5>
                    <div class="table-responsive" id="showNote">
                        <p class="text-center lead mt-5">Please Wait ...</p>
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
    <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>

    <!-- FILE AJAX FOR CHATBOX -->
    <script src="./ajax/student/chatbox.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>




    <script>
        $(document).ready(function() {
            $('table').DataTable();
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
                    type: 'post',
                    url: "./controllers/etstablishmentController.php",
                    data: {
                        action: 'display_notes'
                    },
                    success: function(response) {
                        console.log(response)
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