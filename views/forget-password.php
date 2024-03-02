<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/assets/css/forget-password.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>connexion</title>
</head>

<body>

    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="card">
                        <div class="text-center">
                            <img src="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png" style="height: 110px;width: 110px;">
                        </div>
                        <div class="card-body">
                            <div class="text-center mt-4">
                                <h1 class="h2">إعادة تعيين كلمة المرور</h1>
                                <p class="lead">
                                 أدخل عنوان بريدك الإلكتروني وسنرسل لك تعليمات لإعادة تعيين كلمة مرورك.
                                </p>
                            </div>
                            <p id="error" style="display: none">error</p>
                            <div class="m-sm-4">
                                <form id='forget-form'>
                                    <div class="form-group">
                                        <label style="color:#072853">Adresse e-mail</label>
                                        <input class="form-control form-control-lg" dir='rtl' id='email_forget' type="email" name="email" placeholder="أدخل بريدك الإلكتروني">
                                    </div>
                                    <div class="text-center mt-3">

                                        <button type="submit" id='btn' class="btn btn-lg mt-2">إعادة تعيين كلمة المرور </button>
                                    </div>
                                </form>
                                <div class="mt-5">
                                    <a id='retourPage' href="<?php echo BASE_URL ?>/se-connecter">العودة إلى صفحة تسجيل الدخول</a>
                                </div>

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
            // on submit...
            $('#forget-form').submit(function(e) {
                e.preventDefault();
                $("#error").hide();
                // password required
                var email = $("input#email").val();
                if (email == "") {
                    $("#error").fadeIn().text("* المرجوا ادخال البريد الإلكتروني").css('color', 'white');
                    $("input#email").focus();
                    return false;
                }

                // ajax
                $.ajax({
                    type: "GET",
                    url: "./controllers/ajax.php",
                    data: {
                        email_forget: $("#email_forget").val()
                    },
                    success: function(data) {
                        console.log(data);
                        if ($.trim(data) == "Message sent") {
                            $("#error").fadeIn().text("تم إرسال لك البريد الإلكتروني !!").css('color', 'white');
                            window.location.assign(base_url + "/confirm-code");

                        } else if ($.trim(data) == "this email not found") {
                            $("#error").fadeIn().text("!! هذا البريد الإلكتروني غير موجود ").css('color', 'white');
                        } else if (data == "Le messag pas envoyé") {
                            Swal.fire({
                                icon: 'error',
                                title: "!! حدث خطأ ",
                                text: "حاول مرة أخرى",
                                color: 'red',

                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "!! حدث خطأ ",
                                text: "حاول مرة أخرى",
                                color: 'red',

                            })
                        }
                    }
                });
            });
            return false;
        });
    </script>
</body>

</html>