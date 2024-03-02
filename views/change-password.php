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
    <title>change password</title>
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
                                 <p class="lead">
                                     أدخل كلمة مرور جديدة لتغيير كلمة المرور الخاصة بك
                                </p>

                            </div>
                            <p id="error" style="display: none">error</p>
                            <div class="m-sm-4">
                                <form id='forget-form'>
                                    <div class="form-group">
                                        <label class="d-flex flex-row-reverse" style="color:#072853;">كلمة مرور جديدة</label>
                                        <input class="form-control form-control-lg"  id='new_password' type="password" placeholder="nouveau mot de passe">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="d-flex flex-row-reverse" style="color:#072853;">تأكيد كلمة المرور</label>
                                        <input class="form-control form-control-lg"  id='confirme_new_password' type="password" placeholder="confimer mot de passe">
                                    </div>
                                    <input type="hidden" id='email_to_change' value='<?php echo $email?>'>
                                    <div class="text-center mt-3">
                                        <button type="submit" id='btn' class="btn btn-lg mt-2"> إعادة ضبط</button>
                                    </div>
                                </form>
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
            // on submit... code confirmation  -------------------
            $('#forget-form').submit(function(e) {
                e.preventDefault();
                $("#error").hide();
                // password required
                var new_password = $("input#new_password").val();
                if (new_password == "") {
                    $("#error").fadeIn().text(" المرجوا ادخال كلمة المرور ").css('color', 'white');
                    $("input#new_password").focus();
                    return false;
                }
                var confirme_new_password = $("input#confirme_new_password").val();
                if (confirme_new_password == "") {
                    $("#error").fadeIn().text(" المرجوا ادخال تأكيد كلمة المرور  ").css('color', 'white');
                    $("input#confirme_new_password").focus();
                    return false;
                }

                if (confirme_new_password != new_password) {
                    $("#error").fadeIn().text("كلمة مرور جديدة مختلفة على تأكيد كلمة المرور").css('color', 'white');
                    $("input#confirme_new_password").focus();
                    return false;
                }

                // ajax
                $.ajax({
                    type: "POST",
                    url: "./controllers/ajax.php",
                    data: {
                        new_password: $("#new_password").val(),
                        email_to_change: $("#email_to_change").val()
                    },
                    success: function(data) {
                        if($.trim(data) == 'password is change'){
                            window.location.assign(base_url+'/change-password-success');
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: "!! حدث خطأ ",
                                text: "فشل تغيير كلمة المرور , حاول مرة أخرى",
                                color: 'red',

                            })
                        }
                    }
                });
            });
            return false;
        });
    </script>