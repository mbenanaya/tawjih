<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php'); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Gestion des articles d'études à l'étranger</title>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
        }
        label.error {
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
                        <li class="breadcrumb-item active">articles</li>
                    </ol>
                </nav>
            </div>

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-4 d-flex justify-content-center align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-decoration-none"><a href="<?php echo BASE_URL ?>/gestion-pays">Gerer les pays</a></li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <button type="button" class="btn text-white px-3" data-bs-toggle="modal" data-bs-target="#addArticleModal" style="background: #57ae74;" id='add_pays'>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-2">Ajouter nouveau article</span>
                </button>

                <!-- new Article modal -->
                <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter nouveau article</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="newArticleForm" enctype="multipart/form-data">

                                <div class="row row-cols-1 row-cols-lg-12 justify-content-center">
                                    <div class="col-12 col-lg-6 row row-cols-1 row-cols-md-2">
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="titre">Titre d'article</label>
                                            <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre d'article">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label" for="lien">Lien</label>
                                            <input type="text" class="form-control" name="lien" id="lien" placeholder="Taper un lien">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label" for="image">Image</label>
                                            <input type="file" class="form-control" name="image" id="image" accept="image/jpeg, image/png, image/gif">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label" for="pdf">Pdf</label>
                                            <input type="file" class="form-control" name="pdf" id="pdf" accept="application/pdf">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label" for="audio">Audio</label>
                                            <input type="file" class="form-control" name="audio" id="audio" accept="audio/*">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label" for="video">Vidéo</label>
                                            <input type="file" class="form-control" name="video" id="video" accept="video/*">
                                        </div>

                                        <div id="countries" class="form-group mb-4"></div>
                                    </div>

                                    <div class="col-12 col-lg-6 ">
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea id="description" name="description"  placeholder="Description d'article"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" id="addNewArt" name="addNewArt" class="btn btn-success">Ajouter</button>
                                </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Update Article modal -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="updateModalLabel">Modifier les information d'article</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="updateArticleForm" enctype="multipart/form-data">
                                <input type="hidden" id="idUpdate" name="idUpdate">

                                <div class="row row-cols-1 row-cols-lg-12 justify-content-center">
                                    <div class="col-12 col-lg-6 row row-cols-1 row-cols-md-2">
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="titreUpdate">Titre d'article</label>
                                            <input type="text" class="form-control" name="titreUpdate" id="titreUpdate" placeholder="Taper le nouveau titre">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label" for="lienUpdate">Lien</label>
                                            <input type="text" class="form-control" name="lienUpdate" id="lienUpdate" placeholder="Taper le nouveau lien">
                                        </div>

                                        <div class="form-group my-4">
                                            <label class="form-label" for="imageUpd">Image</label>
                                            <input type="file" class="form-control" name="imageUpd" id="imageUpd" accept="image/jpeg, image/png, image/gif">
                                            <img id="currImage" style="max-width: 150px;">
                                        </div>

                                        <div class="form-group my-4">
                                            <label class="form-label" for="pdfUpd">Pdf</label>
                                            <input type="file" class="form-control" name="pdfUpd" id="pdfUpd" accept="application/pdf">
                                            <input type="text" readonly class="form-control" id="currPdf">
                                        </div>

                                        <div class="form-group my-4">
                                            <label class="form-label" for="audioUpd">Audio</label>
                                            <input type="file" class="form-control" name="audioUpd" id="audioUpd" accept="audio/*">
                                            <input type="text" readonly class="form-control" id="currAudio">
                                        </div>

                                        <div class="form-group my-4">
                                            <label class="form-label" for="videoUpd">Vidéo</label>
                                            <input type="file" class="form-control" name="videoUpd" id="videoUpd" accept="video/*">
                                            <input type="text" readonly class="form-control" id="currVideo">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <div class="form-group my-4">
                                            <label class="form-label" for="descriptionUpdate">Description</label>
                                            <textarea id="descriptionUpdate" name="descriptionUpdate"  placeholder="Description d'article"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" id="updArticle" name="updArticle" class="btn btn-success">Modifier</button>
                                </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <p class="text-center font-weight-normal">Le nombre total d'articles : <span class='font-italic font-weight-bold' id="totalArticles"></span></p>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div >
                        <div id="articlesContainer" class="table-responsive text-danger"></div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js" integrity="sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_fr.min.js" integrity="sha512-J09lQZepqsxLm1HOKW1ljCSU9Ua87itcnjqRTlKIheEWbGlMO90QQK0Mj/eshCqdoUsADzNisjqr1X8D3hN1cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js" integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script src="./views/assets/js/article_etr.js"></script>
</body>

</html>