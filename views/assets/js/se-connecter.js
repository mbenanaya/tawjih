
$(document).ready(function($){
    // hide messages 
    $("#error").hide();
    // on submit...
    $('#form_login').submit(function(e){
        e.preventDefault();
        $("#error").hide();
        //email required
        var email = $("input#email").val();
        if(email == ""){
            $("#error").fadeIn().text("* المرجوا ادخال البريد الإلكتروني");
            $("input#email").focus();
            return false;
        }
        // password required
        var password = $("input#password").val();
        if(password == ""){
            $("#error").fadeIn().text("* المرجوا ادخال كلمة المرور");
            $("input#password").focus();
            return false;
        }

        // ajax
        $.ajax({
            type:"POST",
            url:"./controllers/ajax.php",
            data:{email:$("#email").val(),password:$("#password").val(),login:$('#login').val()},
            success: function(data){
                console.log(data);
                if(data.trim()  == "informations correctes"){
                    //$("#form_login").fadeOut(); 
                    window.location.assign(base_url+"/dashboard-student");
                }else if(data.trim() == "informations incorrect"){
                    $("#error").fadeIn().text("البريد الإلكتروني أو كلمة المرور غير صالحة");
                }else if(data.trim() == "nonActive"){
                    Swal.fire({
                        icon: 'error',
                        title:"!! حدث خطأ ",
                        text: "الحساب غير مفعل بعد تحقق من بريدك الالكتروني, يوجد هناك رابط تفعيل",                      
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title:"!! حدث خطأ ",
                        text: "حاول مرة أخرى",
                        color: 'red',

                    })
                } 
            }
        });
    }); 
    return false;
}); 
                