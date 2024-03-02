$(document).ready(function($) {

    function getCountriesCount() {
        let interval
        let count = 0
        $.ajax({
            url: './controllers/PaysController.php',
            type: "post",
            data: { action: "getCount" },
            dataType: "json",
            success: function(data) {
                console.log(data)
                let totalCount = data.count;
                $('#totalPays').text(totalCount)
            },
            error: function(xhr, textStatus, error) {
                console.log(error)
            }
        })
    }
    getCountriesCount()

    getCountries();

    function addNewCountry() {

        var submitButton = $("#addNewC");
        var newCountryForm = $("#newCountryForm");
        newCountryForm
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    nomPays: {
                        required: true,
                    },
                    nomPaysFr: {
                        required: true,
                    },
                    imagePays: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },

                },
                messages: {
                    nomPays: {
                        required: "Nom de pays est obligatoire",
                    },
                    nomPaysFr: {
                        required: "Nom de pays en Français est obligatoire",
                    },
                    imagePays: {
                        required: "Image de pays est obligatoire",
                    },
                    description: {
                        required: "Description est obligatoire",
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    var caption = submitButton.html();
                    $.ajax({
                        url: './controllers/PaysController.php',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            submitButton.attr("disabled", false).html(caption);
                            $('#addCountryModal').modal('hide');
                            $('.modal-backdrop').remove();
                            if (response.success) {
                                form.reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "Bien",
                                    text: response.message,
                                    allowOutsideClick: false,
                                });
                            } else if (response.exists) {
                                console.log(response);
                                Swal.fire({
                                    icon: "error",
                                    title: "Erreur !!",
                                    text: response.exMessage,
                                });
                            } else {
                                console.log(response);
                                Swal.fire({
                                    icon: "error",
                                    title: "Erreur !!",
                                    text: response.message,
                                });
                            }

                            getCountries();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                            Swal.fire({
                                icon: "error",
                                title: "Erreur !!",
                                text: "Une erreur est survenue, reéssayer une autre fois",
                            });
                            submitButton.attr("disabled", false).html(caption);
                        },
                    });
                },
            });
        $("#newCountryForm").trigger("reset");
        getCountries();

    }
    addNewCountry();

    function getCountries() {
        $.ajax({
            url: './controllers/PaysController.php',
            type: "post",
            data: { action: "showCountries" },
            dataType: "json",
            success: function(data) {

                var tableContainer = $('#tableContainer');
                countriesTable = ''
                if (data.length) {
                    console.log("countries done");
                    countriesTable = '<table class="table table-hover bg-light table-nowrap table-striped-columns text-center"> <thead> <tr> <th scope="col">ID</th> <th scope="col">Nom pays AR</th><th scope="col">Nom pays FR</th><th scope="col">Image pays</th><th scope="col">Description</th><th scope="col">Action</th> </tr> </thead> <tbody>';
                    $.each(data, function() {
                        countriesTable += '<tr> <td>' +
                            this.idPays +
                            '</td> <td>' +
                            this.nomPays +
                            '</td> <td>' +
                            this.nomPaysFr +
                            '</td> <td> <img src="uploads/etranger/pays/' +
                            this.imagePays +
                            '" alt="' + this.nomPaysFr + '" style="width: 60px;height: 100%"></td> <td>' +
                            this.description +
                            '</td><td> <button id="updCountryButton" type="button" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn text-light" data-id="' + this.idPays + '"> <i class="bx bx-pencil fs-4" style="color: #0401c1;font-size: 20px;"></i> </button> <button id="delete" class="btn text-light" data-id="' + this.idPays + '"> <i class="fa-solid fa-trash-can" style="color: #d80e0e;font-size: 20px;"></i> </button> </td> </tr>';
                    })
                    countriesTable += '</tbody> </table>'
                } else {
                    tableContainer.html(data.message);
                    console.log("empty");
                }
                tableContainer.html(countriesTable)



            },
            error: function(xhr, text, error) {
                console.log(error)
            }
        });
    }

    function getCountryInfos() {
        $(document).on('click', '#updCountryButton', function(e) {
            e.preventDefault()
            var idPaysUpdate = $(this).data('id');

            $.ajax({
                url: './controllers/PaysController.php',
                type: "post",
                data: { idPaysUpdate: idPaysUpdate, action: "getCountryById" },
                dataType: "json",
                success: function(data) {
                    console.log('showed')
                    $('#idPaysUpdate').val(data.idPays);
                    $('#nomPaysUpdate').val(data.nomPays);
                    $('#nomPaysFrUpdate').val(data.nomPaysFr);
                    $('#imagePaysUp').attr('src', 'uploads/etranger/pays/' + data.imagePays);
                    $('#descriptionUpdate').val(data.description);
                },
                error: function(xhr, textStatus, error) {
                    console.log(error)
                }
            })
        })
    }
    getCountryInfos()

    function updateCountry() {

        var submitButton = $("#updCountry");
        var updateCountryForm = $("#updateCountryForm");
        updateCountryForm
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    var caption = submitButton.html();
                    $.ajax({
                        url: './controllers/PaysController.php',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            submitButton.attr("disabled", false).html(caption);
                            $('#updateModal').modal('hide');
                            $('.modal-backdrop').remove();

                            if (response.success) {
                                form.reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "Bien",
                                    text: response.message,
                                    allowOutsideClick: false,
                                });
                            } else {
                                console.log(response);
                                Swal.fire({
                                    icon: "error",
                                    title: "Erreur !!",
                                    text: response.message,
                                });
                            }

                            getCountries();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                            Swal.fire({
                                icon: "error",
                                title: "Erreur !!",
                                text: "Une erreur est survenue, reéssayer une autre fois",
                            });
                            submitButton.attr("disabled", false).html(caption);
                        },
                    });
                },
            });
        $("#updateCountryForm").trigger("reset");
        getCountries();

    }
    updateCountry();

    function deleteCountry() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault()
            var idPaysDelete = $(this).data('id');

            Swal.fire({
                title: 'tes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: './controllers/PaysController.php',
                        type: "post",
                        data: { idPaysDelete: idPaysDelete, action: "deleteCountry" },
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            if (data.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: 'Supprimé!',
                                    text: data.message,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        getCountries();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur !!',
                                    text: data.message,
                                    showConfirmButton: true,
                                })
                            }
                        },
                        error: function(xhr, textStatus, error) {
                            console.log(error)
                        }
                    })

                }
            })
        })
    }
    deleteCountry();
})