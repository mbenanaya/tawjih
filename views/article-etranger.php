<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./views/assets/inlcudes/head.php') ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link rel="stylesheet" href="./views/assets/css/article-etranger.css">
    
</head>
<body style="background-color: #eee;">
    <?php  include('./views/assets/inlcudes/head-info-site.php') ?>
    <?php include('./views/assets/inlcudes/navbar.php')?>

    <main id="main" class="main p-5" style="margin-bottom: 10rem;">

        <div id="order-heading" class="row">
            <div class="col-10 px-0 d-flex flex-column justify-content-center p-4">
                <h2 class="text-center text-black fw-normal" id="titre"></h2>
                <p class="text-center mt-3 mb-0"><span id="created_at"></span><b class="text-dark"><span> Tawjih </span>بواسطة </b></p>
            </div>
            <div class="col-2 px-0">
                <img class="rounded-2" id="article_image" alt="image" style="width: 100%;height: 100%;">
            </div>
        </div>

        <div class="wrapper bg-white">
            <div id="description" class="pt-3 px-4"></div>
        </div>
    </main>
    
    <?php include 'whats.php' ?>
    <?php include('./views/assets/inlcudes/footer.php') ?>
    <script src="./views/assets/js/jquery.min.js"></script>
    <script src="./views/assets/js/bootstrap.min.js"></script>
    <script src="./views/assets/js/jquery.sticky.js"></script>
    <script src="./views/assets/js/homePage.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
    <script src="./views/assets/js/show_article_etr.js"></script>
</body>
</html>