<?php 
    if(isset($_SESSION['code']) && isset($_SESSION['email_to_change'])){
        $email = $_SESSION['email_to_change'];
    }else{
        header("Location: ".BASE_URL);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/assets/css/forget-password.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>confirm code</title>
</head>

<body style=" background-color: #90e0ef; ">

    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png" style="height: 110px;width: 110px;">
                            </div>
                            <div class="text-center mt-4">
                                <h1 class="h2 mb-5">إعادة تعيين كلمة المرور</h1>
                                <p dir='rtl'>
                                    يرجى فحص عنوان البريد الإلكتروني
                                    <?php echo $email; ?>
                                    للحصول على رمز التأكيد لإعادة تعيين كلمة المرور الخاصة بك.
                                </p>
                                <p class="lead" dir='rtl'>
                                أدخل رمز التأكيد الذي توصلت به في بريدك الإلكتروني <span class='small'><?php echo $email; ?></span>
                                </p>

                            </div>
                            <p id="error" style="display: none">error</p>
                            <div class="m-sm-4">
                                <form id='forget-form'>
                                    <div class="form-group">
                                        <label class="d-flex flex-row-reverse" style="color:#072853;">رمز التأكيد</label>
                                        <input class="form-control form-control-lg" dir='rtl' id='code' type="text" name="code" placeholder="code de confirmation">
                                    </div>
                                    <div class="text-center mt-3">

                                        <button type="submit" id='btn' class="btn btn-lg mt-2"> تأكيد </button>
                                    </div>
                                </form>
                                <!-- <div class="mt-5">
                                    <a id='retourPage' href="<?php echo BASE_URL ?>/se-connecter">العودة إلى صفحة تسجيل الدخول</a>
                                </div> -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const base_url = "<?php echo BASE_URL ?>";
    </script>

    <script>
        $(document).ready(function($) {

            // hide messages 
            $("#error").hide();
            $("#show_message").hide();
            // on submit... code confirmation  -------------------
            $('#forget-form').submit(function(e) {
                e.preventDefault();
                $("#error").hide();
                // password required
                var code = $("input#code").val();
                if (code == "") {
                    $("#error").fadeIn().text(" المرجوا ادخال رمز التأكيد ").css('color', 'white');
                    $("input#code").focus();
                    return false;
                }

                // ajax
                $.ajax({
                    type: "POST",
                    url: "./controllers/ajax.php",
                    data: {
                        code: $("#code").val()
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.trim() == "not good") {
                            $("#error").fadeIn().text("رمز خاطئ").css('color', 'white');
                        } else if (data.trim() == "good") {
                        $("#error").fadeIn().text(" ... انتظر ").css('color', 'white');
                        window.location.assign(base_url+"/change-password");

                        }
                    }
                });
            });
            return false;
        });
    </script>