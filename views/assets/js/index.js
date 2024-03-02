
$(document).ready(function($){
    // hide messages 
    $("#error").hide();
    // on submit form signup...
    $('#form_signup').submit(function(e){
        e.preventDefault();
        $("#error").hide();
        //email required
        var email = $("input#email").val();
        if(email == ""){
            $("#error").fadeIn().text("* البريد الإلكتروني مطلوب");
            $("input#email").focus();
            return false;
        }
        // password required
        var password = $("input#password").val();
        if(password == ""){
            $("#error").fadeIn().text("* كلمة المرور مطلوبة");
            $("input#password").focus();
            return false;
        }

        // ajax
        $.ajax({
            type:"POST",
            url:"./controllers/ajax.php",
            data:{email:$("#email").val(),password:$("#password").val(),signup:$('#signup').val()},
            success: function(data){
                console.log(data)
                if(data == "Message has been sent"){
                    Swal.fire({
                        icon: 'success',
						title: 'جيد',
                        text: 'تم إنشاء الحساب بنجاح.\n افحص بريدك الإلكتروني لتفعيل الحساب',
                    })
                }else if(data == "Cet email existe déjà!"){
                    Swal.fire({
                        icon: 'error',
                        title: "هذا البريد الإلكتروني موجود بالفعل!!",
                        text: 'أدخل بريد إلكتروني مغاير',
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title:"!! حدث خطأ ",
                        text: "  .تعذر إرسال الرسالة إلى بريدك الإلكتروني \n, حاول مرة أخرى",

                    })
                } 
            }
        });
    }); 






    // on submit form contat...
    $('#form_contact').submit(function(e){
        e.preventDefault();
        $("#error_contact").hide();
        //first-name required
        var first_name = $("input#first-name").val();
        if(first_name == ""){
            $("#error_contact").fadeIn().text("* first name required").css('color','red');
            $("input#first-name").focus();
            return false;
        }
        //last-name required
        var last_name = $("input#last-name").val();
        if(last_name == ""){
            $("#error_contact").fadeIn().text("* last name required").css('color','red');
            $("input#last-name").focus();
            return false;
        }
        //email required
        var email = $("input#email_contact").val();
        if(email == ""){
            $("#error_contact").fadeIn().text("* email required").css('color','red');
            $("input#email_contact").focus();
            return false;
        }
        // password required
        var message = $("#message").val();
        if(message == ""){
            $("#error_contact").fadeIn().text("* message required").css('color','red');
            $("#message").focus();
            return false;
        }

        // ajax
        $.ajax({
            type:"GET",
            url:"./controllers/ajax.php",
            data:{
                email_contact:$("#email_contact").val(),
                message:$("#message").val(),
                first_name:$("#first-name").val(),
                last_name:$("#last-name").val()
            },
            success: function(data){
                console.log(data);
                if($.trim(data) == "Message email contact has been sent"){
                    window.location.assign(base_url+"/mail-success")
                }else{
                    Swal.fire({
                        icon: 'error',
                        title:"!! حدث خطأ ",
                        text: "  .تعذر إرسال الرسالة إلى بريد الإلكتروني \n, حاول مرة أخرى",

                    })
                } 
            }
        });
    }); 
    return false;
}); 
                
