<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css"
        integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gestion des pays</title>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
        }
        .error {
            color: red;
            margin-top: .25rem;
            margin-bottom: 0;
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
    <main id="main" class="main">

        <div class="my-3">

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/dashboard-admin">Home</a></li>
                        <li class="breadcrumb-item active">pays</li>
                    </ol>
                </nav>
            </div>

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex justify-content-center align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>/etudes-a-letranger">Gerer les articles</a></li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <button type="button" class="btn text-white px-3" data-bs-toggle="modal" data-bs-target="#addCountryModal" style="background: #57ae74;" id='add_pays'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">Ajouter nouveau pays</span>
                </button>

                <!-- new Country modal -->
                <div class="modal fade" id="addCountryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter nouveau pays</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="newCountryForm" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="form-label" for="nomPays">Nom Pays Arabe</label>
                                    <input type="text" class="form-control" name="nomPays" id="nomPays" placeholder="Nom de pays Arabe">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="nomPaysFr">Nom Pays Français</label>
                                    <input type="text" class="form-control" name="nomPaysFr" id="nomPaysFr" placeholder="Nom de pays Français">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="imagePays">Image du pays</label>
                                    <input type="file" class="form-control" name="imagePays" id="imagePays" placeholder="Image de pays" accept="image/jpeg, image/png, image/jpg">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" id="addNewC" name="addNewC" class="btn btn-success">Ajouter</button>
                                </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Update Country modal -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateModalLabel">Modifier les information du pays</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="updateCountryForm" enctype="multipart/form-data">
                                <input type="hidden" id="idPaysUpdate" name="idPaysUpdate">
                                <div class="form-group">
                                    <label class="form-label" for="nomPaysUpdate">Nom Pays Arabe</label>
                                    <input type="text" class="form-control" name="nomPaysUpdate" id="nomPaysUpdate" placeholder="Nom de pays Arabe">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="nomPaysFrUpdate">Nom Pays Français</label>
                                    <input type="text" class="form-control" name="nomPaysFrUpdate" id="nomPaysFrUpdate" placeholder="Nom de pays Français">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="imagePaysUpdate">Télécharger une nouvelle image</label>
                                    <input type="file" class="form-control" name="imagePaysUpdate" id="imagePaysUpdate" placeholder="Image de pays">
                                </div>

                                <div class="form-group d-flex flex-column">
                                    <label class="form-label">L'image actuelle</label>
                                    <img id="imagePaysUp" src="" alt="" style="width: 200px;height: 200px;">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="descriptionUpdate">Description</label>
                                    <input type="text" class="form-control" name="descriptionUpdate" id="descriptionUpdate" placeholder="Description">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" id="updCountry" name="updCountry" class="btn btn-success">Modifier</button>
                                </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <p class="text-center font-weight-normal">Le nombre total de pays : <span class='font-italic font-weight-bold' id="totalPays"></span></p>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class=''>
                        <div id="tableContainer" class="table-responsive text-danger"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js"
        integrity="sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_ar.min.js"
        integrity="sha512-nb2K94mYysmXkqlnVuBdOagDjQ2brfrCFIbfDIwFPosVjrIisaeYDxPvvr7fsuPuDpqII0fwA51IiEO6GulyHQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js"
        integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="./views/assets/js/pays.js"></script>
</body>

</html>