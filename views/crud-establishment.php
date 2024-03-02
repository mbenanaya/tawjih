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
                        <li class="breadcrumb-item active">établissement</li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <!-- Button trigger modal -->
                <button class="btn text-white px-3" style="background: #57ae74;" id='add_etablissement'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">ajouter nouveau établissement</span>
                </button>
                <p class="text-center font-weight-normal">Le nombre total de établissement : <span class='font-italic font-weight-bold' id="total"></span></p>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class=''>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap align-middle table-borderless text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Logo</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Libellé</th>
                                        <th scope="col">Filiéres</th>
                                        <th scope="col">dernier délai pour l'inscription</th>
                                        <th class='text-center' scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='body_etablissement'>
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
        const base_url = "<?php echo BASE_URL ?>";
    </script>
    <script>
        $(document).ready(function($) {
            function totalEtablissement() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        total_etablissement: 'total_etablissement',
                    },
                    success: function(data) {
                        $('#total').html(data);
                    }
                })
            }
            totalEtablissement();

            function etablissement() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/crud-controller.php",
                    data: {
                        crud_etablissement: 'etablissement',
                    },
                    success: function(data) {
                        console.log(data)
                        $('#body_etablissement').html(data);
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
                                            id_etablissement_delete: $(this).val(),
                                            path_logo: $(this).children(":first").val(),
                                        },
                                        success: function(response) {
                                            console.log(response)
                                            if (response.trim() == 'delete') {
                                                Swal.fire(
                                                    'Supprimé!',
                                                    "l'établissement a été supprimé.",
                                                    'success',
                                                ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        //location.reload()
                                                        etablissement();
                                                        totalEtablissement();
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

                        // update etablissement :
                        $('.update_etablissement').click(function() {                            
                            const idetablissement = $(this).val();
                            const libelle = $(this).children(":first").val();
                            const filiere = $(this).children().eq(1).val();
                            const last_deadline = $(this).children().eq(2).val();
                            const logo = $(this).children().eq(3).val();
                            
                            window.location.assign(base_url+"/update-establishment?establishmentId="+idetablissement);
                        })
                    }
                });
            }

            etablissement();

            // function for update etablissement
            function updateEtablissement(id, libelle, filiere, last_deadline, logo) {
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
                                    <h4 class="mb-0"><i class="fa-solid fa-square-pen"></i> Modifier une établissement</h4>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="etablissementId" value='${id}'>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">Logo :</label>
                                                <input type="file" class="form-control" id="logo" value='${logo}'>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">libelle:</label>
                                                <input type="text" class="form-control" id="libelle" value='${libelle}'>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">filiéres:</label>
                                                <textarea id="filiere" class="form-control">${filiere}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student-name" class="form-label">dernier délai pour l'inscription:</label>
                                                <input type='date' id="last_deadline" class="form-control"  value='${last_deadline}'/>
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
                        const etablissementId = Swal.getPopup().querySelector('#etablissementId').value
                        const logo = Swal.getPopup().querySelector('#logo').value
                        const libelle = Swal.getPopup().querySelector('#libelle').value
                        const filiere = Swal.getPopup().querySelector('#filiere').value
                        const last_deadline = Swal.getPopup().querySelector('#last_deadline').value
                        if ((logo == '') || (libelle == '') || (filiere == '') || (last_deadline == '')) {
                            Swal.showValidationMessage(`Tous les champs sont obligatoires`)
                        }
                        return {
                            etablissementId: etablissementId,
                            logo: logo,
                            libelle: libelle,
                            filiere: filiere,
                            last_deadline: last_deadline,
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        type: "GET",
                        url: "./controllers/crud-controller.php",
                        data: {
                            id_etablissement_update: result.value.etablissementId,
                            logo: result.value.logo,
                            libelle: result.value.libelle,
                            filiere: result.value.filiere,
                            last_deadline: result.value.last_deadline,
                        },
                        success: function(response) {
                            console.log(response);
                            etablissement();
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


            $('#add_etablissement').click(function(){
                window.location.assign(base_url+"/add-establishment")
            });
        })
    </script>
</body>

</html>