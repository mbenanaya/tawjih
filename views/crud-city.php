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
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-admin">Home</a></li>
                        <li class="breadcrumb-item active">villes</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <!-- Button trigger modal -->
                <button class="btn text-white px-3" style="background: #57ae74;" id='add_ville'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">ajouter nouveau Ville</span>
                </button>
                <p class="text-center font-weight-normal">Le nombre total de villes : <span class='font-italic font-weight-bold' id="total"></span></p>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class=''>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Ville</th>
                                        <th scope="col">Région</th>
                                        <th class='text-center' scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='body_ville'>
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
            function totalVilles() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        total_villes: 'total_villes',
                    },
                    success: function(data) {
                        $('#total').html(data);
                    }
                })
            }
            totalVilles();
            function ville() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        crud_ville: 'ville',
                    },
                    success: function(data) {
                        $('#body_ville').html(data);
                        // delete ville
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
                                            id_ville_delete: $(this).val()
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
                                                        ville();
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

                        // update ville :
                        $('.update_ville').click(function() {
                            const idville = $(this).val();
                            const nameville = $(this).children(":first").val();
                            const region = $(this).children().eq(1).val();
                            const idRegion = $(this).children().eq(2).val();
                            updateVille(idville, nameville, region, idRegion);
                        })
                    }
                });
            }

            ville();

            // function for update ville
            function updateVille(id, nameVille, region, idRegion) {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        regionParVille: 'region for update city',
                        oldRegion: idRegion,
                    },
                    success: function(regionData) {
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
                                            <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Modifier une Ville</h4>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" class="form-control" id="villeId" value='${id}'>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="student-name" class="form-label">Ville :</label>
                                                        <input type="text" class="form-control" id="nameVille" value='${nameVille}'>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="student-name" class="form-label"> Région :</label>
                                                        <select class="form-control" id="region">
                                                            <option value='${idRegion}'>${region}</option>
                                                            ${regionData}
                                                        </select>
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
                                const villeId = Swal.getPopup().querySelector('#villeId').value
                                const nameVille = Swal.getPopup().querySelector('#nameVille').value
                                const newRegion = Swal.getPopup().querySelector('#region').value
                                if ((nameVille == '')) {
                                    Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                                }
                                return {
                                    villeId: villeId,
                                    nameVille: nameVille,
                                    newRegion: newRegion,
                                }
                            }
                        }).then((result) => {
                            $.ajax({
                                type: "GET",
                                url: "./controllers/crud-controller.php",
                                data: {
                                    id_ville_update: result.value.villeId,
                                    nameVille: result.value.nameVille,
                                    newRegion: result.value.newRegion,
                                },
                                success: function(response) {
                                    console.log(response);
                                    ville();
                                    if ($.trim(response) == "update") {
                                        Swal.fire({
                                            position: 'bottom-end',
                                            width: '500px',
                                            icon: 'success',
                                            text: 'la ville a été Modifier.',
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

                })
            }



            // function for add ville
            function addVille() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        Allregions: 'region for add city',
                    },
                    success: function(regionsData) {
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
                                    <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Ajouter une Ville</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label"> Ville:</label>
                                                <input type="text" class="form-control" id="ville">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label"> Région :</label>
                                                <select class="form-control" id="region">
                                                    ${regionsData}
                                                </select>
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
                                const ville = Swal.getPopup().querySelector('#ville').value
                                const region = Swal.getPopup().querySelector('#region').value
                                if ((ville == '' || region == '')) {
                                    Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                                }
                                return {
                                    ville: ville,
                                    region: region
                                }
                            }
                        }).then((result) => {
                            $.ajax({
                                type: "GET",
                                url: "./controllers/crud-controller.php",
                                data: {
                                    add_ville: 'add-ville',
                                    ville: result.value.ville,
                                    region: result.value.region,
                                },
                                success: function(response) {
                                    console.log(response);
                                    ville();
                                    if ($.trim(response) == "added") {
                                        Swal.fire({
                                            position: 'bottom-end',
                                            width: '500px',
                                            icon: 'success',
                                            text: 'la ville a été Ajouté avec success.',
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
                })
            }

            $('#add_ville').click(addVille);
        })
    </script>
</body>

</html>