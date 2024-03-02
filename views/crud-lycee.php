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
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-crud-lycee">Home</a></li>
                        <li class="breadcrumb-item active">lycées</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <!-- Button trigger modal -->
                <button class="btn text-white px-3" style="background: #57ae74;" id='add_lycee'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">ajouter nouveau Lycée</span>
                </button>
                <p class="text-center font-weight-normal">Le nombre total de lycée : <span class='font-italic font-weight-bold' id="total"></span></p>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class=''>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nom en Français</th>
                                        <th scope="col">Nom en Arabe</th>
                                        <th scope="col">Adresse</th>
                                        <th class='text-center' scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='body_lycee'>
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
            function totalLycee() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        total_lycees: 'total_lycees',
                    },
                    success: function(data) {
                        $('#total').html(data);
                    }
                })
            }
            totalLycee();

            function lycee() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        crud_lycee: 'lycee',
                    },
                    success: function(data) {
                        $('#body_lycee').html(data);
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
                                            id_lycee_delete: $(this).val()
                                        },
                                        success: function(response) {
                                            if (response.trim() == 'delete') {
                                                Swal.fire(
                                                    'Supprimé!',
                                                    'le lycée a été supprimé.',
                                                    'success',
                                                ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        //location.reload()
                                                        lycee();
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

                        // update lycee :
                        $('.update_lycee').click(function() {
                            const idlycee = $(this).val();
                            const nameFrLycee = $(this).children(":first").val();
                            const nameArLycee = $(this).children().eq(1).val();
                            const adresse = $(this).children().eq(2).val();
                            updateLycee(idlycee, nameFrLycee, nameArLycee, adresse);
                        })
                    }
                });
            }

            lycee();

            // function for update lycee
            function updateLycee(id, nameFrLycee, nameArLycee, adresse) {
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
                                    <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Modifier un Lycée</h4>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="lyceeId" value='${id}'>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">Nom en Français :</label>
                                                <input type="text" class="form-control" id="nameFrLycee" value='${nameFrLycee}'>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">Nom en Arabe :</label>
                                                <input type="text" class="form-control" id="nameArLycee" value='${nameArLycee}'>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">Adresse :</label>
                                                <textarea id="adresse" class="form-control">${adresse}</textarea>
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
                        const lyceeId = Swal.getPopup().querySelector('#lyceeId').value
                        const nameFrLycee = Swal.getPopup().querySelector('#nameFrLycee').value
                        const nameArLycee = Swal.getPopup().querySelector('#nameArLycee').value
                        const adresse = Swal.getPopup().querySelector('#adresse').value
                        if ((nameFrLycee == '') || (nameArLycee == '') || (adresse == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            lyceeId: lyceeId,
                            nameFrLycee: nameFrLycee,
                            nameArLycee: nameArLycee,
                            adresse: adresse,
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            id_lycee_update: result.value.lyceeId,
                            nameFrLycee: result.value.nameFrLycee,
                            nameArLycee: result.value.nameArLycee,
                            adresse: result.value.adresse,
                        },
                        success: function(response) {
                            console.log(response);
                            lycee();
                            if ($.trim(response) == "update") {
                                Swal.fire({
                                    position: 'bottom-end',
                                    width: '500px',
                                    icon: 'success',
                                    text: 'le lycée a été Modifier.',
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



            // function for add lycee
            function addLycee() {
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
                            <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Ajouter un Lycée</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student-name" class="form-label">Nom en Français :</label>
                                        <input type="text" class="form-control" id="nameFrLycee">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student-name" class="form-label">Nom en Arabe :</label>
                                            <input type="text" class="form-control" id="nameArLycee">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student-name" class="form-label">Adresse :</label>
                                            <textarea id="adresse" class="form-control"></textarea>
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
                        const nameFrLycee = Swal.getPopup().querySelector('#nameFrLycee').value
                        const nameArLycee = Swal.getPopup().querySelector('#nameArLycee').value
                        const adresse = Swal.getPopup().querySelector('#adresse').value
                        if ((nameFrLycee == '') || (nameFrLycee == '') || (adresse == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            nameFrLycee: nameFrLycee,
                            nameArLycee: nameArLycee,
                            adresse: adresse
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            add_lycee: 'add-lycee',
                            nameFrLycee: result.value.nameFrLycee,
                            nameArLycee: result.value.nameArLycee,
                            adresse: result.value.adresse
                        },
                        success: function(response) {
                            console.log(response);
                            lycee();
                            if ($.trim(response) == "added") {
                                Swal.fire({
                                    position: 'bottom-end',
                                    width: '500px',
                                    icon: 'success',
                                    text: 'lycée a été Ajouté avec success.',
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

            $('#add_lycee').click(addLycee);
        })
    </script>
</body>

</html>