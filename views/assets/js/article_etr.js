$(document).ready(function($) {

    $('#description').summernote({
        height: 300,
        lang: 'ar-AR',
        onChange: function() {
            var desc = this.code;
            if (isTextArabic(desc)) {
                this.summernote('notebook.align.right');
            } else {
                this.summernote('notebook.align.left');
            }
        }
    })

    function isTextArabic(text) {
        return /[\u0600-\u06FF]/.test(text);
    }


    $('#descriptionUpdate').summernote({
        height: 300,
    })

    getArticles();

    function getArticlesCount() {
        $.ajax({
            url: './controllers/ArticleEtrController.php',
            type: "post",
            data: { action: "getCount" },
            dataType: "json",
            success: function(data) {
                console.log(data)
                $('#totalArticles').text(data.count);
            },
            error: function(xhr, textStatus, error) {
                console.log(error)
            }
        })
    }
    getArticlesCount()

    function getCountriesNames() {
        $.ajax({
            url: './controllers/PaysController.php',
            type: "post",
            data: { action: "getCountriesNames" },
            dataType: "json",
            success: function(data) {
                console.log('Countries done')
                var articlesContainer = $('#countries');
                Content = ''
                if (data.length) {
                    Content = '<label class="form-label" for="allCountries">Choisir un pays</label> <select class="form-select" name="CountryName" id="CountryName">';
                    Content += '<option selected disabled>Choisir un pays</option>'
                    $.each(data, function() {
                        Content += '<option value="' + this.idPays + '">' + this.nomPaysFr + '</option>'
                    })
                    Content += '</select>'
                } else {
                    message = '<div class="text-center fs-1 fw-semibold text-danger">Vous devez d\'abord ajouter un pays</div>'
                    articlesContainer.html(message);
                    console.log("empty");
                }
                articlesContainer.html(Content)
            },
            error: function(xhr, textStatus, error) {
                console.log(error)
            }
        })
    }
    getCountriesNames()


    function addNewArticle() {

        var submitButton = $("#addNewArt");
        var newArticleForm = $("#newArticleForm");
        newArticleForm
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    titre: {
                        required: true,
                    },
                    description_article: {
                        required: true,
                    },
                    CountryName: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                },
                messages: {
                    titre: {
                        required: "Titre est obligatoire",
                    },
                    description_article: {
                        required: "Description est obligatoire",
                    },
                    CountryName: {
                        required: "Nom de pays est obligatoire",
                    },
                    image: {
                        required: "L'image est obligatoire",
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    var caption = submitButton.html();
                    $.ajax({
                        url: './controllers/ArticleEtrController.php',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(response) {
                            console.log(response.message)
                            submitButton.attr("disabled", false).html(caption);
                            $('#addArticleModal').modal('hide');
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

                            getArticles()
                            getArticlesCount()
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
        $("#newArticleForm").trigger("reset");
        getArticles()

    }
    addNewArticle()
    getArticles();
    getArticlesCount()

    function getArticles() {
        $.ajax({
            url: './controllers/ArticleEtrController.php',
            type: "post",
            data: { action: "showArticles" },
            dataType: "json",
            success: function(data) {
                console.log("articles done");

                var articlesContainer = $('#articlesContainer');
                Content = ''
                if (data.length) {
                    Content = '<table class="table table-hover bg-light table-nowrap table-striped-columns text-center"> <thead> <tr> <th scope="col">ID</th> <th scope="col">Titre</th> <th scope="col">Lien</th> <th scope="col">Pays</th> <th scope="col">Action</th> </tr> </thead> <tbody>';
                    $.each(data, function() {
                        Content += '<tr> <td>' +
                            this.id +
                            '</td> <td>' +
                            this.titre +
                            '</td> <td>' +
                            this.lien +
                            '</td> <td>' +
                            this.nomPaysFr +
                            '</td><td> <button id="updArticleButton" type="button" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn text-light" data-id="' + this.id + '"> <i class="bx bx-pencil fs-4" style="color: #0401c1;font-size: 20px;"></i> </button> <button id="delete" class="btn text-light" data-id="' + this.id + '"> <i class="fa-solid fa-trash-can" style="color: #d80e0e;font-size: 20px;"></i> </button> </td> </tr>';
                    })
                    Content += '</tbody> </table>'
                } else {
                    articlesContainer.html(data.message);
                    console.log("empty");
                }
                articlesContainer.html(Content)

            },
            error: function(xhr, text, error) {
                console.log(error)
            }
        });
    }

    function getArticleInfos() {
        $(document).on('click', '#updArticleButton', function(e) {
            e.preventDefault()
            var idUpdate = $(this).data('id');

            $.ajax({
                url: './controllers/ArticleEtrController.php',
                type: "post",
                data: { idUpdate: idUpdate, action: "getArticleById" },
                dataType: "json",
                success: function(data) {
                    console.log('showed')
                    $('#idUpdate').val(data.id);
                    $('#titreUpdate').val(data.titre);
                    $("#currImage").attr('src', 'uploads/etranger/article/images/' + data.image)
                    $("#currPdf").val(data.pdf)
                    $("#currAudio").val(data.audio)
                    $("#currVideo").val(data.video)
                    var description = data.description_article.replace(/<[^>]*>/g, '');
                    $('#descriptionUpdate').summernote('code', $('<div>').html(description).text())

                    $('#lienUpdate').val(data.lien);
                },
                error: function(xhr, textStatus, error) {
                    console.log(error)
                }
            })
        })
    }
    getArticleInfos()

    function updateArticle() {

        var submitButton = $("#updArticle");
        var updateArticleForm = $("#updateArticleForm");
        updateArticleForm
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    var caption = submitButton.html();
                    $.ajax({
                        url: './controllers/ArticleEtrController.php',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            submitButton.attr("disabled", false).html(caption);
                            $('#updateModal').modal('hide');
                            $('.modal-backdrop').remove();

                            if (data.success) {
                                form.reset()
                                Swal.fire({
                                    icon: "success",
                                    title: "Bien",
                                    text: data.message,
                                    allowOutsideClick: false,
                                })
                            } else {
                                console.log(data);
                                Swal.fire({
                                    icon: "error",
                                    title: "Erreur !!",
                                    text: data.message,
                                })
                            }

                            getArticles()
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
        $("#updateArticleForm").trigger("reset");
        getArticles();
    }
    updateArticle()

    function deleteArticle() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault()
            var idDelete = $(this).data('id');
            console.log(idDelete)

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
                        url: './controllers/ArticleEtrController.php',
                        type: "post",
                        data: { idDelete: idDelete, action: "deleteArticle" },
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
                                        getArticles();
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
                            getArticles()
                            getArticlesCount()
                        },
                        error: function(xhr, textStatus, error) {
                            console.log(error)
                        }
                    })

                }
            })
        })
    }
    deleteArticle()
})