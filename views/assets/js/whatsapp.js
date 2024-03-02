$(function () {
    var number = $('#numWhatsapp')
	var message = $('#messageWhatsapp')
    function getData(){        
        $.ajax({
            url: './controllers/WhatsappController.php',
            type: 'post',
            data: { action: "getData"},
            dataType: "json",
            success: function(data) {
                console.log("get infos success")
                number.val(data.numWhatsapp)
                message.val(data.messageWhatsapp)
            },
            error: function(xhr, text, error) {
                console.log(error)
            }
        })
    }
    getData();
	

	var submitButton = $("#saveWhatsappData");
    var formWhatsapp = $("#formWhatsapp");
    formWhatsapp
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            rules: {
                numWhatsapp: {
                    required: true,
                    minlength: 10,
                },
                messageWhatsapp: {
                    required: true,
                },
            },
            messages: {
                numWhatsapp: {
                    required: "Veuillez entrer le numero whatsapp !",
                },
                messageWhatsapp: {
                    required: "Veuillez entrer le message !",
                },
            },

            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);
                var caption = submitButton.html();
                $.ajax({
                    url: './controllers/WhatsappController.php',
        			type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (response) {
                        console.log(response.message)
                        submitButton.attr("disabled", false).html(caption);
                        if (response.success) {
                            form.reset();
                            getData();
                            Swal.fire({
                                icon: "success",
                                title: "Bien",
                                text: "Les informations ont étés mise à jour avec succès",
                                allowOutsideClick: false,
                            });                            

                        } else {
                            console.log(response);
                            Swal.fire({
                                icon: "error",
                                title: "Error !!",
                                text: "Une erreur est survenue",
                            });
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                        Swal.fire({
                            icon: "error",
                            title: "Error !!",
                            text: "Une erreur est survenue",
                        });
                        submitButton.attr("disabled", false).html(caption);
                    },
                });
            },
        });
    $("#formWhatsapp").trigger("reset");
})