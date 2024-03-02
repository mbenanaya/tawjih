<?php include('./controllers/session-admin.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Inscription | Établissements</title>    
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #eee;
            /*  background-color: #f2f6fc; */
        }

        .project:hover {
            cursor: pointer;
        }


        .project .row {
            margin: 0;
            padding: 15px 0;
            margin-bottom: 15px
        }

        .project div[class*='col-'] {
            border-right: 1px solid #eee
        }

        .project .text h3 {
            margin-bottom: 0;
            color: #555
        }

        .project .text small {
            color: #aaa;
            font-size: 0.75em
        }

        .project .project-date span {
            font-size: 0.9em;
            color: #999
        }

        .project .image {
            max-width: 50px;
            min-width: 50px;
            height: 50px;
            margin-right: 15px
        }

        .project .time,
        .project .comments,
        .project .project-progress {
            color: #999;
            font-size: 0.9em;
            margin-right: 20px
        }

        .project .time i,
        .project .comments i,
        .project .project-progress i {
            margin-right: 5px
        }

        .project .project-progress {
            width: 200px
        }

        .project .project-progress .progress {
            height: 4px
        }

        .project .card {
            margin-bottom: 0
        }

        @media (max-width: 991px) {
            .project .right-col {
                margin-top: 20px;
                margin-left: 65px
            }

            .project .project-progress {
                width: 150px
            }
        }

        @media (max-width: 480px) {
            .project .project-progress {
                display: none
            }
        }

        .has-shadow {
            -webkit-box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1), -1px 0 2px rgba(0, 0, 0, 0.05);
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1), -1px 0 2px rgba(0, 0, 0, 0.05);
        }

        .bg-white {
            background: #fff !important;
        }

        .bg-red {
            background: #ff7676 !important;
            color: #fff
        }

        .bg-red:hover {
            color: #fff
        }

        .bg-blue {
            background: #85b4f2 !important;
            color: #fff
        }

        .bg-blue:hover {
            color: #fff
        }

        .bg-yellow {
            background: #eef157 !important;
            color: #fff
        }

        .bg-yellow:hover {
            color: #fff
        }

        .bg-green {
            background: #54e69d !important;
            color: #fff
        }

        .bg-green:hover {
            color: #fff
        }

        .bg-orange {
            background: #ffc36d !important;
            color: #fff
        }

        .bg-orange:hover {
            color: #fff
        }

        .bg-violet {
            background: #796AEE !important;
            color: #fff
        }

        .bg-violet:hover {
            color: #fff
        }

        .bg-gray {
            background: #ced4da !important
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
        <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-2 d-flex align-items-center">
            <!-- <h1>Dashboard</h1> -->
            <nav class="d-inline-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL . '/dashboard-admin' ?>">Home</a></li>
                    <li class="breadcrumb-item active">récus</li>
                </ol>
                <div class="ml-5 mt-2"><i class="fa-solid fa-school" style="font-size: 25px; color: #2025b6;"></i><span style="font-size: 20px; margin-left:10px">Établissements</span></div>
            </nav>
        </div>
        <section class="projects no-padding-top">
            <p>choisir un établissement pour déposer récu d'inscription</p>
            <div class="container" id="card_establishment">
                <!-- establishment-->
                <!-- <div class="project" role='button' id='0'>
                    <div class="row bg-white has-shadow">
                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                            <div class="project-title d-flex align-items-center">
                                <div class="image has-shadow"><img src="./views/assets/images/ensa-m.png" alt="..." class="img-fluid"></div>
                                <div class="text">
                                    <h3 class="h4">ENSA MARRAKECH</h3><small>Lorem Ipsum Dolor</small>
                                </div>
                            </div>
                            <div class="project-date"><span class="hidden-sm-down">dernier délai 4:24 AM</span></div>
                        </div>
                         <div class="right-col col-lg-6 d-flex align-items-center">
                            <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                            <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                            <div class="project-progress">
                                <div class="progress">
                                    <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> -->
            </div>
            <!-- start  CHAT AREAT FOR STUDENT -->
            <?php include('./views/chat.php'); ?>
            <!--end  CHAT AREAT FOR STUDENT -->
        </section>

    </main>
    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
    <!-- end scripts  -->
    <!-- script-dashboard-student  -->
    <?php include('./views/assets/inlcudes/script-dashboard-student.php'); ?>

    <script>
        const base_url = "<?php echo BASE_URL ?>";
    </script>

    <script type="text/javascript">
        $(document).ready(function($) {
             // get establishment id from url
             url_string = window.location.href;
            url = new URL(url_string);
            var student = url.searchParams.get("student");
            // get all establishments
            $.ajax({
                type: 'GET',
                url: "./controllers/etstablishmentController.php",
                data: {
                    card_establishment: "establishments",
                    student: student // get code massar from url
                },
                success: function(data) {
                    $('#card_establishment').append(data);
                    $('.project').click(function() {
                        var id = $(this).attr('id')
                        window.location.assign(base_url+"/recus-admin?establishment_id="+id+"&student="+student)
                    })
                                       
                }
            })
            // on click on establishment
        })
    </script>
</body>

</html>