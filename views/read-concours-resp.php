<?php include('./controllers/SessionResponsable.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
    <title>Concours</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        /* * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        } */

        #main {
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        /* body {
            background-color: #fff3e0;
        } */

        #order-heading {
            background-color: #edf4f7;
            position: relative;
            border-top-left-radius: 25px;
            max-width: 990px;
            padding-top: 20px;
            margin: 30px auto 0px;
        }

        #order-heading .text-uppercase {
            font-size: 0.9rem;
            color: #777;
            font-weight: 600;
        }

        #order-heading .h4 {
            font-weight: 600;
        }

        #order-heading .h4+div p {
            font-size: 0.8rem;
            color: #777;
        }

        .close {
            padding: 10px 15px;
            background-color: #777;
            border-radius: 50%;
            position: absolute;
            right: -15px;
            top: -20px;
        }

        .wrapper {
            padding: 0px 50px 50px;
            max-width: 990px;
            margin: 0px auto 40px;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
        }

        .table th {
            border-top: none;
        }

        .table thead tr.text-uppercase th {
            font-size: 0.8rem;
            padding-left: 0px;
            padding-right: 0px;
        }

        .table tbody tr th,
        .table tbody tr td {
            font-size: 0.9rem;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: 5px;
        }

        .table-responsive {
            height: 100px;
        }

        .list div b {
            font-size: 0.8rem;
        }

        .list .order-item {
            font-weight: 600;
            color: #6db3ec;
        }

        .list:hover {
            background-color: #f4f4f4;
            cursor: pointer;
            border-radius: 5px;
        }

        label {
            margin-bottom: 0;
            padding: 0;
            font-weight: 900;
        }

        button.btn {
            font-size: 0.9rem;
            background-color: #66cdaa;
        }

        button.btn:hover {
            background-color: #5cb99a;
        }

        .price {
            color: #5cb99a;
            font-weight: 700;
        }

        p.text-justify {
            font-size: 0.9rem;
            margin: 0;
        }

        .row {
            margin: 0px;
        }

        .subscriptions {
            border: 1px solid #ddd;
            border-left: 5px solid #ffa500;
            padding: 10px;
        }

        .subscriptions div {
            font-size: 0.9rem;
        }

        @media(max-width: 425px) {
            .wrapper {
                padding: 20px;
            }

            body {
                font-size: 0.85rem;
            }

            .subscriptions div {
                padding-left: 5px;
            }

            img+label {
                font-size: 0.75rem;
            }

        }

        audio::-webkit-media-controls-panel {
            background-color: #66cdaa;
        }

        .count_name {
            font-size: small;
        }

        canvas.pdf-canvas {
            width: 100% !important;
        }
    </style>
</head>

<body>

    <!-- start header  -->
    <header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
        <?php include('./views/assets/inlcudes/header-responsable.php');  ?>
    </header>
    <!-- end header  -->
    <!-- start sidebar  -->
    <aside id="sidebar" class="sidebar">
        <?php include('./views/assets/inlcudes/sidebar-responsable.php'); ?>
    </aside>
    <!-- end  sidebar  -->

    <!-- MAIN -->
    <main id="main" class="main bg-light mt-5">
        <div class="" id="order-heading">
            <img class="rounded float-end mr-2" id="image-concours" alt="image" width="130" height="100">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="text-uppercase">
                    <p><span id="countdown" style="color:#ea4c4c; font-size:x-large "> <span id="j"></span> </span> باقي من الزمن </p>
                </div>
                <div class="h4" id="title"></div>
                <div class="pt-1">
                    <p><span id="date_create"></span><b class="text-dark"><span> Aljisr tawjih </span>بواسطة </b></p>
                </div>
            </div>
        </div>
        <div class="wrapper bg-white">
            <div id="description" class="pt-3">
            </div>

            <div class="pdf-container mt-5"></div>

            <div class="pt-2 border-bottom mb-3"></div>
            <div id="div_audio">
                <div class="ibox-title">
                    <h3 class="float-end">كيفية التسجيل بصوت الموجه</h3><br><br>
                </div>
                <div class="text-center mt-1">
                    <audio id="audio" controls></audio>
                </div>
            </div>
            <div class="d-sm-flex justify-content-center rounded my-3 subscriptions">
                <a id="lien_ecole" href="" class="btn btn-danger w-50" target="_blanck">رابط التسجيل</a>
            </div>
            <div class="pt-2 border-bottom mb-3"></div>
            <div id="div_video" class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="text-end mt-3 mt-4"> فيديو يوضح طريقة التسجيل</h5>
                    </div>
                    <div class="ibox-content">
                        <figure>
                            <iframe id="video" frameborder="0" allowfullscreen="" data-aspectratio="0.8211764705882353" style="width: 100% !important; height: 429.475px;" autoplay="false" controls></iframe>
                        </figure>
                    </div>
                </div>
            </div>

            <!-- <div class="row border rounded p-1 my-3">
                <div class="col-md-6 py-3">
                    <div class="d-flex flex-column align-items start">
                        <b>Billing Address</b>
                        <p class="text-justify pt-2">James Thompson, 356 Jonathon Apt.220,</p>
                        <p class="text-justify">New York</p>
                    </div>
                </div>
                <div class="col-md-6 py-3">
                    <div class="d-flex flex-column align-items start">
                        <b>Shipping Address</b>
                        <p class="text-justify pt-2">James Thompson, 356 Jonathon Apt.220,</p>
                        <p class="text-justify">New York</p>
                    </div>
                </div>
            </div>
            <div class="pl-3 font-weight-bold">Related Subsriptions</div>
            <div class="d-sm-flex justify-content-between rounded my-3 subscriptions">
                <div>
                    <b>#9632</b>
                </div>
                <div>May 22, 2017</div>
                <div>Status: Processing</div>
                <div>
                    Total: <b> $68.8 for 10 items</b>
                </div>
            </div> -->
        </div>


    </main>

    <!-- start  CHAT AREAT FOR STUDENT -->
    <?php include('./views/chat.php'); ?>
    <!--end  CHAT AREAT FOR STUDENT -->

    <!-- start scripts  -->
    <?php include('./views/assets/inlcudes/scripts-dashboard.php'); ?>
    <!-- end scripts  -->
    <!-- script-dashboard-student  -->
    <?php include('./views/assets/inlcudes/script-dashboard-responsable.php'); ?>
    <!-- JavaScript sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>

    <script>
        const base_url = "<?php echo BASE_URL ?>";
    </script>

    <script>
        $(document).ready(function($) {
            // get establishment id from url
            url_string = window.location.href;
            url = new URL(url_string);
            var id = url.searchParams.get("id");


            function getData() {
                var id_value = id;
                $.ajax({
                    type: "POST",
                    url: "./controllers/ArticleController.php",
                    data: {
                        id: id_value
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        $("#title").text(data.titre_article);
                        $("#date_create").text(data.created_at);
                        $("#description").html(data.description);
                        $("#image-concours").attr("src", base_url + "/uploads/articles/images/" + data.image);
                        if (!$.isEmptyObject($.trim(data.audio))) {
                            $("#audio").attr("src", base_url + "/uploads/articles/audios/" + data.audio);
                        } else {
                            $("#div_audio").hide();
                        }

                        $("#lien_ecole").attr("href", data.lien_ecole);

                        if (($.isEmptyObject($.trim(data.video))) && ($.isEmptyObject($.trim(data.lien_video)))) {
                            $("#div_video").hide();
                        } else if (!$.isEmptyObject($.trim(data.video))) {
                            $("#video").attr("src", base_url + "/uploads/articles/videos/" + data.video);
                        } else {
                            $("#video").attr("src", data.lien_video);
                        }

                        var date_concours = data.date_concours;

                        // Set the date we're counting down to
                        var countDownDate = new Date(date_concours).getTime();

                        // Update the count down every 1 second
                        var x = setInterval(function() {
                            // Get today's date and time
                            var now = new Date().getTime();

                            // Find the distance between now and the count down date
                            var distance = countDownDate - now;

                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            // Output the result in an element with id="countdown"
                            $("#countdown").html(days + "<span class='count_name'>jour </span>" + hours + "<span class='count_name'>h </span> " + minutes + "<span class='count_name'>m  </span> " + seconds + "<span class='count_name'>s </span>");


                            // If the count down is over, write some text
                            if (distance < 0) {
                                clearInterval(x);
                                $("#countdown").html("انتهى تاريخ التسجيل");
                            }
                        }, 1000);

                        //read pdf 
                        var pdf = base_url + "/uploads/articles/pdfs/" + data.pdf;
                        pdfjsLib.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js';
                        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js';
                        pdfjsLib.getDocument({
                            url: pdf
                        }).promise.then(function(pdf) {
                            var container = document.querySelector('.pdf-container');
                            var scale = 1.5;

                            function renderPage(pageNum) {
                                pdf.getPage(pageNum).then(function(page) {
                                    var viewport = page.getViewport({
                                        scale: scale
                                    });
                                    var canvas = document.createElement('canvas');
                                    var context = canvas.getContext('2d');
                                    canvas.className = 'pdf-canvas';
                                    canvas.width = viewport.width;
                                    canvas.height = viewport.height;
                                    container.appendChild(canvas);
                                    var renderContext = {
                                        canvasContext: context,
                                        viewport: viewport
                                    };
                                    page.render(renderContext);
                                    if (pageNum < pdf.numPages) {
                                        renderPage(pageNum + 1);
                                    }
                                });
                            }

                            renderPage(1);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText + ' 3yaan');
                    }
                });
            }
            getData()

        });
    </script>

</body>

</html>