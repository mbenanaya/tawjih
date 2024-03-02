$(function () {
   var adminLoginForm = $("#admin_login_form");
   var submitButton = $("#adm_login");
   adminLoginForm
       .submit(function (e) {
           e.preventDefault();
       })
       .validate({
           rules: {
               email: {
                   required: true,
                   email: true
               },
               password: {
                   required: true,
                   minlength: 8
               }
           },
           messages: {
               email: {
                   required: "رجاء أدخل البريد الالكتروني",
                   email: "البريد الالكتروني غير صحيح",
               },
               password: {
                   required: "رجاء أدخل كلمة المرور",
               },
           },
           submitHandler: function (form) {
               var formData = $(form).serialize();
               var caption = submitButton.html();

               $.ajax({
                   url: './controllers/settings/ResponsableController.php',
                   type: "POST",
                   dataType: 'json',
                   data: formData,
                   success: function (response) {

                       if (response.isLogin == true) {
                           window.location.assign(response.url+'/dashboard-responsable');
                           // console.log('login');
                       } else {
                           Swal.fire({
                               icon: "error",
                               title: "Erreur!!",
                               text: response.message,
                           });
                       }

                       $(form).trigger("reset");
                   },
                   error: function (xhr, text, error) {
                       console.log(error)
                       Swal.fire({
                           icon: "error",
                           title: "Erreur!!",
                           text: "Une erreur est survenue",
                       });
                   },
               });
           },
       });
});