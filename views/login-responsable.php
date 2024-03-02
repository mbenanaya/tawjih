<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<head>
    <title>Responsable</title>
<?php include('./views/assets/inlcudes/head.php') ?>
<style>
    #section_4{
        background-image: url('./views/assets/images/slide/vasily-koloda-8CqDvPuo_kI-unsplash.jpg');
        background-position: center;
        background-size: cover;
    }
    #email, #password {
        direction: ltr;
    }

    input[type=email]::placeholder, input[type=password]::placeholder {
        text-align: right; 
    }
</style>
</head>

<body>

   <?php  include('./views/assets/inlcudes/head-info-site.php') ?>

    <!-- NAVBAR -->
    <?php include('./views/assets/inlcudes/navbar.php') ?>
    <main>

        <section class="volunteer-section section-padding" id="section_4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <!-- <h2 class="text-white mb-4" style="text-align: center;">تسجيل الدخول</h2> -->

                        <form class="custom-form volunteer-form mb-5 mb-lg-0" method="post" role="form" id='admin_login_form'>
                            <h3 class="mb-4" style="text-align: center;">سجل الدخول </h3>

                            <div class="row">

                                <div class="col-lg-6 col-12 order-1 order-lg-2">
                                    <input type="email" name="email" id="email"
                                        class="form-control" placeholder="البريد الالكتروني" dir="rtl">
                                </div>

                                <div class="col-lg-6 col-12 order-2 order-lg-1">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="كلمة المرور" dir="rtl">
                                </div>
                                
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="form-control w-50" role="input" id='adm_login' name='resonsable_login'> تسجيل الدخول </button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </section>

    </main>


    <!-- FOOTER -->
    <?php include('./views/assets/inlcudes/footer.php') ?>

    <!-- JAVASCRIPT FILES -->
    <script src="./views/assets/js/jquery.min.js"></script>
    <script src="./views/assets/js/bootstrap.min.js"></script>
    <script src="./views/assets/js/jquery.sticky.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.4.1/jquery.appear.min.js"></script>
    <script src="./views/assets/js/custom.js"></script>
    <?php require_once './views/assets/inlcudes/jQuery.php' ?>
    <script src="./views/assets/js/login-responsable.js"></script>
    <!--start  fichier home page js  -->
    <script src="./views/assets/js/homePage.js"></script>
   <!--start  fichier home page js  -->
</body>

</html>