<!doctype html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head.php') ?>
    <link rel="shortcut icon" href="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png"
        type="image/x-icon">

    <style>
        .art_cont {
            background: #d9e0e7;
            transition: all .4s ease-in-out;
        }
        .art_cont:hover {
            box-shadow: 17px 0 60px #d3dcdc;
            background-color: #f5f5f5;
        }
    </style>
    
</head>

<body>
    <?php  include('./views/assets/inlcudes/head-info-site.php') ?>
    <?php include('./views/assets/inlcudes/navbar.php')?>

    <main id="main" class="main py-5 px-3 mb-5">
        <div class="px-5 pb-5">
            <div id="articlesContainer" class="px-5" ></div>
        </div>
    </main>
    
    <?php include 'whats.php' ?>
    <?php include('./views/assets/inlcudes/footer.php') ?>
    <script src="./views/assets/js/jquery.min.js"></script>
    <script src="./views/assets/js/bootstrap.min.js"></script>
    <script src="./views/assets/js/jquery.sticky.js"></script>
    <script src="./views/assets/js/homePage.js"></script>
    <script src="./views/assets/js/sh_arts_etr.js"></script>
</body>
</html>