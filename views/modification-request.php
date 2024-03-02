<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Request update info </title>
    <style>
        body {
            /* background: #f6f9fc; */
            margin-top: 20px;
        }

        /* booking */

        .bg-light-blue {
            background-color: #e9f7fe !important;
            color: #3184ae;
            padding: 7px 18px;
            border-radius: 4px;
        }

        .bg-light-green {
            background-color: rgba(40, 167, 69, 0.2) !important;
            padding: 7px 18px;
            border-radius: 4px;
            color: #28a745 !important;
        }

        .buttons-to-right {
            position: absolute;
            right: 0;
            top: 40%;
        }

        .btn-gray {
            color: #666;
            background-color: #eee;
            padding: 7px 18px;
            border-radius: 4px;
        }

        .booking:hover .buttons-to-right .btn-gray {
            opacity: 1;
            transition: .3s;
        }

        .buttons-to-right .btn-gray {
            opacity: 0;
            transition: .3s;
        }

        .btn-gray:hover {
            background-color: #36a3f5;
            color: #fff;
        }

        .booking {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 30px;
        }

        .booking:last-child {
            margin-bottom: 0px;
            border-bottom: none;
            padding-bottom: 0px;
        }

        @media screen and (max-width: 575px) {
            .buttons-to-right {
                top: 10%;
            }

            .buttons-to-right a {
                display: block;
                margin-bottom: 20px;
            }

            .buttons-to-right a:last-child {
                margin-bottom: 0px;
            }

            .bg-light-blue,
            .bg-light-green,
            .btn-gray {
                padding: 7px;
            }
        }

        .card {
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            box-shadow: none;
            border: none;
            padding: 25px;
        }

        .mb-5,
        .my-5 {
            margin-bottom: 3rem !important;
        }

        .msg-img {
            margin-right: 20px;
        }

        .msg-img img {
            width: 60px;
            border-radius: 50%;
        }

        img {
            max-width: 100%;
            height: auto;
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
        <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 mt-3 d-flex align-items-center">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-admin">Home</a></li>
                    <li class="breadcrumb-item active">Demande de modification </li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-white mb-5">
                        <div class="card-heading clearfix border-bottom mb-4">
                            <h4 class="card-title">Demande de modification d'informations Personnelles</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                
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
    <!-- for keyboard arabic -->
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>        
        $(document).ready(function($) {
            function ListRequests() {
                $.ajax({
                    type: "GET",
                    url: "./controllers/request-controller.php",
                    data: {
                        list_request: 'list_request'
                    },
                    success: function(list) {                        
                        if ($.trim(list) == "no request") {
                            $(".list-unstyled").empty().html("<h3>Il n'y a pas de demandes</h3>")
                        } else {
                            $(".list-unstyled").empty().html(list)
                            $(".accepter").click(function() {
                                $.ajax({
                                    type: "GET",
                                    url: "./controllers/request-controller.php",
                                    data: {
                                        accepter_id: $(this).attr('value')
                                    },
                                    success: function(resp) {
                                        if ($.trim(resp) == "accept") {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'demande acceptée',
                                                showConfirmButton: false,
                                                timer: 1500
                                            })
                                            ListRequests();
                                        }
                                    }
                                })
                            })

                            $(".refuser").click(function() {
                                Swal.fire({
                                    title: 'êtes-vous sûr?',
                                    text: "Vous ne pourrez pas revenir en arrière! la demande sera refusez!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: 'Annuler',
                                    confirmButtonText: 'Oui, refusez-le!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            type: "GET",
                                            url: "./controllers/request-controller.php",
                                            data: {
                                                refuser_id: $(this).attr('value')
                                            },                                            
                                            success: function(response) {
                                                if ($.trim(response) == "refuse") {
                                                    Swal.fire({
                                                        position: 'top-end',
                                                        icon: 'success',
                                                        title: 'demande refusée',
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    })
                                                    ListRequests();
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

                                    }
                                })                                
                            })
                            $(".delete").click(function() {
                                Swal.fire({
                                    title: 'êtes-vous sûr?',
                                    text: "Vous ne pourrez pas revenir en arrière! la demande sera supprimée!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: 'Annuler',
                                    confirmButtonText: 'Oui, supprimer-le!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            type: "GET",
                                            url: "./controllers/request-controller.php",
                                            data: {
                                                delete_id: $(this).attr('value')
                                            },                                            
                                            success: function(response) {
                                                if ($.trim(response) == "delete") {
                                                    Swal.fire({
                                                        position: 'top-end',
                                                        icon: 'success',
                                                        title: 'demande supprimé',
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    })
                                                    ListRequests();
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

                                    }
                                })                                
                            })
                        }
                    }
                })
            }
            ListRequests();         
        })
    </script>
</body>

</html>