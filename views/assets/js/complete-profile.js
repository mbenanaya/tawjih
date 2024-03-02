// Validate form inputs
function formValidation() {
    var submitButton = $("#register");
    var regForm = $("#complete-reg");
    regForm
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            rules: {
                firstNameArabe: {
                    required: true,
                    minlength: 2,
                },
                lastNameArabe: {
                    required: true,
                    minlength: 2,
                },
                firstName: {
                    required: true,
                    minlength: 3,
                },
                lastName: {
                    required: true,
                    minlength: 3,
                },
                cin: {
                    required: true,
                    minlength: 6,
                },
                image: {
                    required: true,
                    filesize: 1024000,
                    extension: "jpg|jpeg|png|gif|webp",
                },
                sex: {
                    required: true,
                },
                birthDate: {
                    required: true,
                    date: true,
                },
                birthPlace: {
                    required: true,
                },
                codeMassar: {
                    required: true,
                    minlength: 7,
                },
                sector: {
                    required: true,
                },
                bacYear: {
                    required: true,
                },
                region: {
                    required: true,
                },
                city: {
                    required: true,
                },
                school: {
                    required: true,
                },
                adress: {
                    required: true,
                },
                zipCode: {
                    required: true,
                    minlength: 5,
                    digits: true,
                },
                phoneNumber: {
                    required: true,
                    phoneMA: true,
                },
                parentPhone: {
                    required: true,
                    phoneMA: true,
                },
            },
            messages: {
                firstNameArabe: {
                    required: "رجاء أدخل الاسم الشخصي",
                },
                lastNameArabe: {
                    required: "رجاء أدخل الاسم العائلي",
                },
                firstName: {
                    required: "رجاء أدخل الاسم الشخصي بالفرنسية",
                },
                lastName: {
                    required: "رجاء أدخل الاسم العائلي بالفرنسية",
                },
                cin: {
                    required: "رجاء أدخل رقم البطاقة الوطنية",
                },
                image: {
                    required: "يلزمك تحميل صورة",
                    extension: "يجب تحميل صورة فقط",
                    filesize: "يجب تحميل صورة أقل من 1MB",
                },
                sex: {
                    required: "رجاء اختر النوع",
                },
                birthDate: {
                    required: "رجاء أدخل تاريخ الازدياد",
                },
                birthPlace: {
                    required: "رجاء أدخل مكان الازدياد",
                },
                codeMassar: {
                    required: "رجاء أدخل رمز مسار ",
                },
                sector: {
                    required: "رجاء اختر الشعبة ",
                },
                bacYear: {
                    required: "رجاء اختر سنة الباكالوريا",
                },
                region: {
                    required: "رجاء اختر الجهة",
                },
                city: {
                    required: "رجاء اختر المدينة",
                },
                school: {
                    required: "رجاء أدخل اسم المؤسسة",
                },
                adress: {
                    required: "رجاء أدخل العنوان ",
                },
                zipCode: {
                    required: "رجاء أدخل الرمز البريدي ",
                    minlength: "الحد الأدنى لعدد الأرقام هو 5",
                },
                phoneNumber: {
                    required: "رجاء أدخل رقم الهاتف",
                    phoneMA: "رجاء أدخل رقم الهاتف بشكل صحيح",
                },
                parentPhone: {
                    required: "رجاء أدخل رقم هاتف الأب",
                    phoneMA: "رجاء أدخل رقم هاتف الأب بشكل صحيح",
                },
            },

            errorPlacement: function (error, element) {
                if (element.is(":radio")) {
                    error.appendTo(element.parents(".form-check"));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);
                var caption = submitButton.html();
                $.ajax({
                    url: './controllers/ajax.php',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        submitButton.attr("disabled", true).html("انتظر من فضلك...");
                    },
                    success: function (response) {
                        console.log(response)
                        submitButton.attr("disabled", false).html(caption);
                        if (response.trim() == "Added") {
                            form.reset();
                            Swal.fire({
                                icon: "success",
                                title: "جيد",
                                text: "تم التسجيل بنجاح",
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        base_url+"/se-connecter";
                                }
                            });
                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: "error",
                                title: "خطأ",
                                text: "عذرا.. حدث خطأ ما",
                            });
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                        Swal.fire({
                            icon: "error",
                            title: "خطأ",
                            text: "عذرا.. حدث خطأ ما",
                        });
                        submitButton.attr("disabled", false).html(caption);
                    },
                });
            },
        });
    $("#complete-reg").trigger("reset");
    $("#imgPreview").attr("src", '#');
    $("#imgPreview").css({ 'width': '0', 'height': '0' });
    return false;
}


function validatorAdditionalMethods() {
    // Add filesize rule
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            var size = element.files[0].size;
            return this.optional(element) || element.files[0].size <= param;
        },
        "The selected file is too large."
    );

    // Add Arabic letters only rule
    $.validator.addMethod(
        "arabicLetters",
        function (value, element) {
            return this.optional(element) || /^[\u0600-\u06FF\s]$/.test(value);
        },
        "يرجى إدخال حروف عربية فقط"
    );


    // Moroccan phone number method
    $.validator.addMethod(
        "phoneMA",
        function (phone_number, element) {
            phone_number = phone_number.replace(/\s/g, "");
            return this.optional(element) || /^0[67]\d{8}$/.test(phone_number);
        },
        "Please enter a valid Moroccan phone number"
    );

    // Alphanumeric method
    $.validator.addMethod(
        "alphanumeric",
        function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]$/.test(value);
        },
        "Please enter only letters and digits."
    );

    // No whitespaces method
    $.validator.addMethod(
        "nowhitespace",
        function (value, element) {
            return this.optional(element) || /^\S$/i.test(value);
        },
        "No whitespace allowed"
    );
}

// Preview the image
function imagePreview() {
    $("#image").change(function () {
        if (this.files && this.files[0]) {
            var size = this.files[0].size;
            if (size > 1024000) {
                // Clear the file input and show error message
                $(this).val("");
                $("#imagePreview").html("");
                $("#complete-reg").validate().showErrors({
                    image: "يجب تحميل صورة أقل من 1MB",
                });
            } else {
                // Show preview of the uploaded image
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imgPreview").css({
                        "max-width": "200px",
                        "max-height": "200px",
                    });
                    $("#imagePreview").html(
                        '<img src="' +
                        e.target.result +
                        '" class="rounded" style="width: 100%; height: 100%">'
                    );
                };
                reader.readAsDataURL(this.files[0]);
            }
        } else {
            $("#imagePreview").html("");
        }
    });
}

imagePreview();

$(function() {
    function getBacYears() {
        $.ajax({
            url: "./controllers/ajax.php",
            type: "post",
            data: { action: 'getBacYears' },
            dataType: "html",
            success: function(data) {
                $("#bacYearCont").html(data)
            },
            error: function(xhr, text, error) {
                console.log(text)
            }
        })
    }
    getBacYears()

    $("#imagePreview").html("");
    validatorAdditionalMethods();
    formValidation();
});