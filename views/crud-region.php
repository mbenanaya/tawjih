<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Setting | site web</title>
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
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-region">Home</a></li>
                        <li class="breadcrumb-item active">Régions</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <!-- Button trigger modal -->
                <button class="btn text-white px-3" style="background: #57ae74;" id='add_region'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">ajouter nouveau Région</span>
                </button>
                <p class="text-center font-weight-normal">Le nombre total de Régions : <span class='font-italic font-weight-bold' id="total"></span></p>
            </div>

            <div class='row'>
                <div class='col-md-12'>
                    <div class=''>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Région</th>
                                        <th class='text-center' scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='body_region'>

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
    <script>
        $(document).ready(function($) {
            function totalRegion() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        total_region: 'total_region',
                    },
                    success: function(data) {
                        $('#total').html(data);
                    }
                })
            }
            totalRegion();
            function region() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        crud_region: 'region',
                    },
                    success: function(data) {
                        $('#body_region').html(data);
                        // delete region
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
                                            id_region_delete: $(this).val()
                                        },
                                        success: function(response) {
                                            if (response.trim() == 'delete') {
                                                Swal.fire(
                                                    'Supprimé!',
                                                    'la region a été supprimé.',
                                                    'success',
                                                ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        //location.reload()
                                                        region();
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

                        // update region :
                        $('.update_region').click(function() {
                            const idRegion = $(this).val();
                            const nameRegion = $(this).children(":first").val();
                            updateRegion(idRegion,nameRegion);
                        })
                    }
                });
            }

            region();

            // function for update region
            function updateRegion(id,nameRegion) {
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
                                <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Modifier une Région</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" class="form-control" id="regionId" value='${id}'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="student-name" class="form-label">Région :</label>
                                            <input type="text" class="form-control" id="nameRegion" value='${nameRegion}'>
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
                        const regionId = Swal.getPopup().querySelector('#regionId').value
                        const nameRegion = Swal.getPopup().querySelector('#nameRegion').value
                        if ((nameRegion == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            regionId: regionId,
                            nameRegion: nameRegion
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            id_region_update: result.value.regionId,
                            nameRegion: result.value.nameRegion,
                        },
                        success: function(response) {
                            console.log(response);
                            region();
                            if ($.trim(response) == "update") {
                                Swal.fire({
                                    position: 'bottom-end',
                                    width: '500px',
                                    icon: 'success',
                                    text: 'la region a été Modifier.',
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



            // function for add region
            function addRegion() {
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
                                <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Ajouter une Région</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="student-name" class="form-label"> Région:</label>
                                            <input type="text" class="form-control" id="region">
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
                        const region = Swal.getPopup().querySelector('#region').value
                        if ((region == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            region: region
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            add_region: 'add-region',
                            region: result.value.region,
                        },
                        success: function(response) {
                            console.log(response);
                            region();
                            if ($.trim(response) == "added") {
                                Swal.fire({
                                    position: 'bottom-end',
                                    width: '500px',
                                    icon: 'success',
                                    text: 'la région a été Ajouté avec success.',
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

            $('#add_region').click(addRegion);
        })
    </script>
</body>

</html>