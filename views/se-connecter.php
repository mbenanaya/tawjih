
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./views/assets/inlcudes/head.php') ?>
    <title>Se connecter</title>
</head>

<style>
    #section_4{
        background-image: url('./views/assets/images/slide/vasily-koloda-8CqDvPuo_kI-unsplash.jpg');
        background-position: center;
        background-size: cover;
    }
    #error{
        /* text-align: center; */
        /* margin-bottom: -1rem; */
        background-color: rgba(241,37,74,.8);
        border-radius: 15px;
        padding: 0.5rem 0.5rem;
        font-size: 1.1rem;
        color:white;
    }
    
    #email, #password {
        direction: ltr;
    }

    input[type=email]::placeholder, input[type=password]::placeholder {
        text-align: right; 
    }

</style>

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

                        <form class="custom-form volunteer-form mb-5 mb-lg-0" method="post" role="form" id='form_login'>
                            <h3 class="mb-4" style="text-align: center;">سجل دخولك الان</h3>

                            <div class="row">

                                <p id="error" style="display: none" dir='rtl'>error</p>

                                <div class="col-lg-6 col-12 order-1 order-lg-2" dir="rtl">
                                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="البريد الالكتروني">

                                </div>

                                <div class="col-lg-6 col-12 order-2 order-lg-1" dir="rtl">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور">
                                </div>
    
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="form-control w-50" role="input" id='login' name='login'
                                    value='login'> تسجيل الدخول </button>
                            </div>

                            <div>
                                <a href="<?php echo BASE_URL ?>/forget-password" class="d-flex flex-row-reverse link-primary mt-2">نسيت كلمة المرور؟</a>                
                            </div>
                            <div>
                                <a href="<?php echo BASE_URL ?>/#connect" class="d-flex flex-row-reverse link-success mt-2">ليس لديك حساب؟ حساب جديد</a>                
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </section>
        <?php include 'whats.php' ?>
    </main>


    <!-- FOOTER -->
    <?php include('./views/assets/inlcudes/footer.php') ?>
    <!--start  fichier home page js  -->
    <script src="./views/assets/js/homePage.js"></script>
    <!--start  fichier home page js  -->
    <!-- JAVASCRIPT FILES -->
    <script src="./views/assets/js/jquery.min.js"></script>
    <script src="./views/assets/js/bootstrap.min.js"></script>
    <script src="./views/assets/js/jquery.sticky.js"></script>
    <script src="./views/assets/js/click-scroll.js"></script>
    <script src="./views/assets/js/se-connecter.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script> 
        const base_url = "<?php echo BASE_URL ?>";
    </script>


</body>

</html>