<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Inscription | Établissements</title>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
        }

        .card-box {
            padding: 20px;
            border-radius: 3px;
            margin-bottom: 30px;
            background-color: #fff;
        }

        .file-man-box {
            padding: 20px;
            border: 1px solid #e3eaef;
            border-radius: 5px;
            position: relative;
            margin-bottom: 20px
        }

        .file-man-box .file-close {
            color: #f1556c;
            position: absolute;
            line-height: 24px;
            font-size: 24px;
            right: 10px;
            top: 10px;
            visibility: hidden
        }

        .file-man-box .file-img-box {
            line-height: 120px;
            text-align: center
        }

        .file-man-box .file-img-box img {
            height: 64px
        }

        .file-man-box .file-download {
            font-size: 32px;
            color: #98a6ad;
            position: absolute;
            right: 10px
        }

        .file-man-box .file-download:hover {
            color: #313a46
        }

        .file-man-box .file-man-title {
            padding-right: 25px
        }

        .file-man-box:hover {
            -webkit-box-shadow: 0 0 24px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
            box-shadow: 0 0 24px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02)
        }

        .file-man-box:hover .file-close {
            visibility: visible
        }

        .text-overflow {
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
            width: 100%;
            overflow: hidden;
        }

        h5 {
            font-size: 15px;
        }

        /* style of select file */
        .bg-light {
            background-color: #FAFAFA;
            color: #666;
        }

        .br-light {
            border-color: #e7e7e7 !important;
        }

        .br-a {
            border: 1px solid #eeeeee !important;
        }

        .ph30 {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }

        .ph60 {
            padding: 60px !important;
        }

        .pv20 {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }

        .bg-light.dark {
            background-color: #F2F2F2;
        }

        .micro-header {
            color: #999;
            text-align: center;
            font-weight: 400;
            margin-bottom: 20px;
        }

        h4,
        .h4 {
            font-size: 15px;
        }

        .holder-style.holder-active {
            background-color: #FFF;
            border: 2px dashed #70ca63;
        }

        .mb20 {
            margin-bottom: 20px !important;
        }

        .p15 {
            padding: 15px !important;
        }

        .holder-style {
            display: block;
            padding: 9px 16px;
            color: #AAA;
            background-color: #f1f1f1;
            border: 2px dashed #d9d9d9;
            -webkit-transition: all 0.15s ease;
            -moz-transition: all 0.15s ease;
            transition: all 0.15s ease;
        }

        .holder-style.holder-active .holder-icon {
            color: #70ca63;
        }

        .holder-style .holder-icon {
            color: #AAA;
            font-size: 30px;
            padding-bottom: 10px;
        }

        a,
        a:hover,
        a:focus {
            text-decoration: none !important;
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

        <div class="container my-5">

            <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-2 d-flex align-items-center">
                <!-- <h1>Dashboard</h1> -->
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL . '/dashboard-admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item active">Recus</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">liste des reçus<span class="text-muted fw-normal ms-2">(1)</span></h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a aria-current="page" href="#" class="router-link-active router-link-exact-active nav-link active" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="List" aria-label="List">
                                            <i class="bx bx-list-ul"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Grid" aria-label="Grid"><i class="bx bx-grid-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap align-middle table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">logo</th>
                                            <th scope="col">établissement</th>
                                            <th scope="col">Dernier délai</th>
                                            <th scope="col" style="width: 200px;">Filiére</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id='td_logo'><a href="#" class="text-body"></a></td>
                                            <td><span class="badge-soft-success mb-0" id='title'></span></td>
                                            <td><span class="badge badge-soft-danger mb-0" style="font-size: large;" id='delai'></span></td>
                                            <td id="filiere"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- files -->
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

                <div class="container bootstrap snippets bootdey">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 br-a br-light bg-light pv20 ph30">
                            <h4 class="micro-header">Sélectionner le fichier PDF ou WORD</h4>
                            <form id='f' enctype="multipart/form-data">
                                <input type="hidden" id="id_establ_for_recu" name="id_establ_for_recu" value="">
                                <input type="hidden" id="code_massare" name="code_massare" value="">
                                <div class="row text-center" id="content-type">
                                    <label for="file-input" style="cursor: pointer;" class="holder-style p15 mb20 holder-active">
                                        <span class="fa fa-file-o holder-icon"></span>
                                        <br> <span id='fichier'>Sélectionner un fichier</span>
                                    </label>
                                    <input type="file" id="file-input" name="file" style="display: none;">
                                    <span id="error_certificat" style="display: none">error</span>
                                </div>
                                <input id="dock-push" type="submit" class="btn btn-success fs14 fw600 pv15 btn-block" value="Enregistrer file">
                            </form>
                        </div>                        
                        <div class="col-xs-12 col-sm-8 br-a br-light bg-light dark">
                            <div class="content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <div class="row">
                                                    <div class="col-lg-6 col-xl-6">
                                                        <h4 class="header-title m-b-30">vos documents</h4>
                                                    </div>
                                                </div>
                                                <div class="row" id="div-files">
                                                    <!-- <div class="col-lg-3 col-xl-6">
                                                <div class="file-man-box"><a href="" class="file-close"><i class="fa fa-times-circle"></i></a>
                                                    <div class="file-img-box"><img src="https://coderthemes.com/highdmin/layouts/assets/images/file_icons/pdf.svg" alt="icon"></div><a href="#" class="file-download"><i class="fa fa-download"></i></a>
                                                    <div class="file-man-title">
                                                        <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                                        <p class="mb-0"><small>568.8 kb</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xl-6">
                                                <div class="file-man-box"><a href="" class="file-close"><i class="fa fa-times-circle"></i></a>
                                                    <div class="file-img-box"><img src="https://coderthemes.com/highdmin/layouts/assets/images/file_icons/doc.svg" alt="icon"></div><a href="#" class="file-download"><i class="fa fa-download"></i></a>
                                                    <div class="file-man-title">
                                                        <h5 class="mb-0 text-overflow">Bmpfile.bmp</h5>
                                                        <p class="mb-0"><small>8.8 mb</small></p>
                                                    </div>
                                                </div>
                                            </div> -->
                                                </div>
                                                <!-- <div class="text-center mt-3">
                                            <button type="button" class="btn btn-outline-danger w-md waves-effect waves-light"><i class="mdi mdi-refresh"></i> Load More Files</button>
                                        </div> -->
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- container -->
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
    </main>
    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
    <!-- end scripts  -->
    <!-- script-dashboard-student  -->
    <?php include('./views/assets/inlcudes/script-dashboard-student.php'); ?>

    <script src="./views/assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const base_url = "<?php echo BASE_URL ?>";
    </script>

    <script>
        $(document).ready(function($) {
            // get establishment id from url
            url_string = window.location.href;
            url = new URL(url_string);
            var establishment_id = url.searchParams.get("establishment_id");            
            var student = url.searchParams.get("student"); 
            
            // set code massare for hidden input
            $("#code_massare").val(student)

            //----------------------------------------------
            // show establishment
            $.ajax({
                type: 'GET',
                url: "./controllers/etstablishmentController.php",
                data: {
                    establishment_id: establishment_id
                },
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                    $('#title').text(response[1]);
                    $('#delai').text(response[3]);
                    $('#filiere').text(response[2]);
                    //$('#logo').attr('src', response[4]);
                    var img = "<img id='logo' alt='' class='avatar-sm rounded-circle me-2' src='"+response[4]+"'/>";
                    $('#td_logo').html(img);

                    $('#id_establ_for_recu').val(response[0]);
                }
            })

            // input file on change 
            $('#file-input').change(function() {
                var nameFile = this.files[0].name;
                $("#fichier").text(nameFile).css('color', 'blue')
            })

            // display files
            function displayFiles() {
                $.ajax({
                    type: 'GET',
                    url: "./controllers/etstablishmentController.php",
                    data: {
                        id_displayFile: establishment_id,
                        codeMassar: student
                    },
                    success: function(data) {
                        console.log(data);
                        var aucuneFile = "<h3 id='aucune_file' style='color:red;margin-top:15%;text-align:center;'>Aucun fichier déposé</h3>";
                        if (data.trim() === '') {
                            $('#div-files').html(aucuneFile);
                        } else {
                            $('#div-files').empty();
                            $('#div-files').append(data);
                            $("#div-files").on('click', '.file-close', function(e) {
                                e.preventDefault();
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
                                            type: 'GET',
                                            url: "./controllers/etstablishmentController.php",
                                            data: {
                                                id_file_delete: $(this).attr('id'),
                                                path_file: $(this).attr('value')
                                            },
                                            success: function(response) {
                                                console.log(response)
                                                if (response.trim() == 'delete') {
                                                    displayFiles();
                                                    Swal.fire(
                                                        'Supprimé!',
                                                        'le fichier a été supprimé.',
                                                        'success',
                                                    )
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
            displayFiles();

            // add new file
            $('#f').submit(function(e) {
                e.preventDefault();
                $("#error_certificat").hide();
                var file = $("input#file-input").val();
                if (file == '') {
                    $("#error_certificat").fadeIn().text("Aucun fichier sélectionné !!").css('color', 'red');
                    $("input#file-input").focus();
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: "./controllers/etstablishmentController.php",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if ($.trim(response) == "insert") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Votre fiche a été envoyé',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            $("#fichier").text('Sélectionner un fichier')
                            $("#file-input").val('')
                            displayFiles();
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
            })

        })
    </script>
</body>

</html>