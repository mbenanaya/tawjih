<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Setting | BACS</title>
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
                        <li class="breadcrumb-item active">Bac</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <!-- Button trigger modal -->
                <button class="btn text-white px-3" style="background: #57ae74;" id='add_bac'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">ajouter nouveau bac</span>
                </button>
            </div>

            <div class='row'>
                <div class='col-md-12'>
                    <div class=''>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Filière en AR</th>
                                        <th scope="col">Filière en FR</th>
                                        <th class='text-center' scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='body_bac'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>

   <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> 

    <!-- JavaScript sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- for keyboard arabic -->
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
	<script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script> 
    
    <script>
        $(document).ready(function($) {
            function bac() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        crud_bac: 'bac',
                    },
                    success: function(data) {
                        $('#body_bac').html(data);
                        // delete bac
                        $('.delete').click(function() {
                            Swal.fire({
                                title: 'êtes-vous sûr?',
                                text: "Vous ne pourrez pas revenir en arrière!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Annuler',
                                confirmButtonText: 'Oui, supprimez-le!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "GET",
                                        url: "./controllers/crud-controller.php",
                                        data: {
                                            id_bac_delete: $(this).val()
                                        },
                                        success: function(response) {
                                            if (response.trim() == 'delete') {
                                                Swal.fire(
                                                    'Supprimé!',
                                                    'la filière a été supprimé.',
                                                    'success',
                                                ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        //location.reload()
                                                        bac();
                                                    }
                                                })
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

                        // update bac :
                        $('.update_bac').click(function() {
                            const idFiliere = $(this).val();
                            const filiereAr = $(this).children(":first").val();
                            const filiereFr = $(this).children().eq(1).val();
                            updateBac(idFiliere, filiereAr, filiereFr);
                        })
                    }
                });
            }

            bac();

            // function for update bac
            function updateBac(id, bacAr, bacFr) {
                Swal.fire({
                    title: '  ',
                    width: '900px',
                    html: ` <style>
                            body {
                            background-color: #F1F5FE;
                            }
                            .card-header {
                            background-color: #1862ab;
                            color: #fff;
                            }
                            .card-body {
                            background-color: #fff;
                            border: 1px solid #ccc;
                            border-top: none;
                            }
                            .form-label {
                            font-weight: 500;
                            color: #1862ab;
                            }
                            .form-control[readonly] {
                            background-color: #F1F5FE;
                            color: #555;
                            }
                        </style>
                        <div class="container">
                            <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Modifier une filière</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" class="form-control" id="bacId" value='${id}'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student-name" class="form-label">Filière en français :</label>
                                            <input type="text" class="form-control" id="bacFr" value='${bacFr}'>
                                        </div>
                                        
                                    </div>

                                   <div class="col-md-6">
                                        <div class="form-group" dir='rtl'>
                                            <label for="student-name" class="form-label">الشعبة  بالعربية :</label>
                                            <input type="text" class="form-control" id="bacAr" value='${bacAr}'>
                                        </div>                                                                                                                    
                                    </div> 
                                </div>
                            </div>
                            </div>
                        </div>`,
                    showCloseButton: true,
                    showConfirmButton: true,
                    confirmButtonText: 'modifier',
                    allowOutsideClick: false,
                    confirmButtonColor: '#1862ab',
                    preConfirm: () => {
                        const bacId = Swal.getPopup().querySelector('#bacId').value
                        const filierAr = Swal.getPopup().querySelector('#bacAr').value
                        const filierFr = Swal.getPopup().querySelector('#bacFr').value
                        if ((filierAr == '') || (filierFr == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            bacId: bacId,
                            filierAr: filierAr,
                            filierFr: filierFr
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            id_bac_update: result.value.bacId,
                            filierAr: result.value.filierAr,
                            filierFr: result.value.filierFr
                        },
                        success: function(response) {
                            console.log(response);
                            bac();
                            if ($.trim(response) == "update") {
                                Swal.fire({
                                    position: 'bottom-end',
                                    width: '500px',
                                    icon: 'success',
                                    text: 'la filière a été Modifier.',
                                    showCloseButton: false,
                                    showConfirmButton: false,
                                    timer: 2500,
                                });
                            } else if ($.trim(response) == "not update") {
                                console.log(response);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: "une erreur est survenue!",
                                })
                            }
                        }
                    });
                })
            }



            // function for add bac
            function addBac() {
                Swal.fire({
                    title: '  ',
                    width: '900px',
                    html: ` <style>
                            body {
                            background-color: #F1F5FE;
                            }
                            .card-header {
                            background-color: #57ae74;
                            color: #fff;
                            }
                            .card-body {
                            background-color: #fff;
                            border: 1px solid #ccc;
                            border-top: none;
                            }
                            .form-label {
                            font-weight: 500;
                            color: #1862ab;
                            }
                            .form-control[readonly] {
                            background-color: #F1F5FE;
                            color: #555;
                            }
                        </style>
                        <div class="container">
                            <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Ajouter une filière</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student-name" class="form-label">Filière en français :</label>
                                            <input type="text" class="form-control" id="bacFr">
                                        </div>
                                        
                                    </div>

                                   <div class="col-md-6">
                                        <div class="form-group" dir='rtl'>
                                            <label for="student-name" class="form-label">الشعبة  بالعربية :</label>
                                            <input type="text" class="form-control" id="bacAr">
                                        </div>                                                                                                                    
                                    </div> 
                                </div>
                            </div>
                            </div>
                        </div>`,
                    showCloseButton: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Ajouter',
                    allowOutsideClick: false,
                    confirmButtonColor: '#57ae74',
                    preConfirm: () => {
                        const filierAr = Swal.getPopup().querySelector('#bacAr').value
                        const filierFr = Swal.getPopup().querySelector('#bacFr').value
                        if ((filierAr == '') || (filierFr == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            filierAr: filierAr,
                            filierFr: filierFr
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            add_bac: 'add-bac',
                            filierAr: result.value.filierAr,
                            filierFr: result.value.filierFr
                        },
                        success: function(response) {
                            console.log(response);
                            bac();
                            if ($.trim(response) == "added") {
                                Swal.fire({
                                    position: 'bottom-end',
                                    width: '500px',
                                    icon: 'success',
                                    text: 'la filière a été Ajouté avec success.',
                                    showCloseButton: false,
                                    showConfirmButton: false,
                                    timer: 2500,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: "une erreur est survenue!",
                                })
                            }
                        }
                    });
                })
            }

            $('#add_bac').click(addBac);
        })
    </script>
</body>

</html>