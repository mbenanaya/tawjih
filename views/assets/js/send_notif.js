$(function() {

    function getPacks() {
        $.ajax({
            url: "./controllers/SendNotifController.php",
            type: "post",
            data: { action: "getPacks" },
            success: function(data) {
                var packsContainer = $('#packsContainer');
                packsContainer.html(data);
            },
            error: function(xhr, textStatus, error) {
                console.log(error);
            }
        });
    }
    getPacks();

    function getFilieres() {
        $.ajax({
            url: "./controllers/SendNotifController.php",
            type: "post",
            data: { action: "getFilieres" },
            success: function(data) {
                var filieresContainer = $('#filieresContainer');
                filieresContainer.html(data);
            },
            error: function(xhr, textStatus, error) {
                console.log(error);
            }
        });
    }
    getFilieres()

    function getStudents() {

        $("#show").click(function(e) {
            e.preventDefault()

            var pack = $("#pack").val()
            var filiere = $("#filieres").val()

            var isValid = true

            if (!pack && !filiere) {
                isValid = false
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Veillez choisir un pack ou une filiere'
                })
            } else if (pack && !filiere) {
                isValid = true
                console.log('packs selected')
            } else if (filiere && !pack) {
                isValid = true
                console.log('filiere selected')
            }

            if (isValid === true) {
                if (pack && filiere) {
                    $.ajax({
                        url: "./controllers/SendNotifController.php",
                        type: "post",
                        data: { pack: pack, filiere: filiere },
                        success: function(data) {
                            var studsContainer = '<div class="form-group my-5 bg-white rounded-3"><h3 class="text-center text-black fw-semibold">Liste des étudiants</h3></div>'
                            studsContainer += '<div id="studsContainer" class="table-responsive bg-white rounded-3">'                            
                            studsContainer += data
                            studsContainer += '</div>'                           
                            studsContainer += '<div class="form-group my-4"><button type="submit" class="btn btn-success" name="send" id="send">Envoyer</button></div>'
                                                        
                            $("#send_form").empty().html(studsContainer);

                            const selectAllCheckbox = $("#select_all")
                            const checkboxes = $('input[type=checkbox][name="stud[]"]')
                            selectAllCheckbox.on("change", function() {
                                checkboxes.prop("checked", selectAllCheckbox.prop("checked"))
                            })
                        },
                        error: function(xhr, textStatus, error) {
                            console.log(error);
                        }
                    })
                } else if (pack && !filiere) {
                    $.ajax({
                        url: "./controllers/SendNotifController.php",
                        type: "post",
                        data: { pack: pack },
                        success: function(data) {
                            var studsContainer = '<div class="form-group my-5 bg-white rounded-3"><h3 class="text-center text-black fw-semibold">Liste des étudiants</h3></div>'
                            studsContainer += '<div id="studsContainer" class="table-responsive bg-white rounded-3">'                            
                            studsContainer += data
                            studsContainer += '</div>'                           
                            studsContainer += '<div class="form-group my-4"><button type="submit" class="btn btn-success" name="send" id="send">Envoyer</button></div>'
                                                        
                            $("#send_form").empty().html(studsContainer);
                            const selectAllCheckbox = $("#select_all")
                            const checkboxes = $('input[type=checkbox][name="stud[]"]')
                            selectAllCheckbox.on("change", function() {
                                checkboxes.prop("checked", selectAllCheckbox.prop("checked"))
                            })

                        },
                        error: function(xhr, textStatus, error) {
                            console.log(error);
                        }
                    })
                } else if (filiere && !pack) {
                    $.ajax({
                        url: "./controllers/SendNotifController.php",
                        type: "post",
                        data: { filiere: filiere },
                        success: function(data) {
                            var studsContainer = '<div class="form-group my-5 bg-white rounded-3"><h3 class="text-center text-black fw-semibold">Liste des étudiants</h3></div>'
                            studsContainer += '<div id="studsContainer" class="table-responsive bg-white rounded-3">'                            
                            studsContainer += data
                            studsContainer += '</div>'                           
                            studsContainer += '<div class="form-group my-4"><button type="submit" class="btn btn-success" name="send" id="send">Envoyer</button></div>'
                                                        
                            $("#send_form").empty().html(studsContainer);

                            const selectAllCheckbox = $("#select_all")
                            const checkboxes = $('input[type=checkbox][name="stud[]"]')
                            selectAllCheckbox.on("change", function() {
                                checkboxes.prop("checked", selectAllCheckbox.prop("checked"))
                            })

                        },
                        error: function(xhr, textStatus, error) {
                            console.log(error);
                        }
                    })
                }
            }



        });

    }
    getStudents()

    function sendNotification() {
        $("#send_form").submit(function(e) {
            e.preventDefault();
            var sujet = $("#sujet").val();
            var notif_text = $("#notif_text").val()

            var studs = $('input[name="stud[]"]:checked')

            if (studs.length > 0) {
                var studs = studs.map(function() {
                    return this.value;
                }).get();
                console.log(studs)
                $.ajax({
                    type: "post",
                    url: "./controllers/SendNotifController.php",
                    data: {
                        studs: studs,
                        sujet: sujet,
                        notif_text: notif_text
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data.message)
                        if (data.success) {
                            Swal.fire({
                                icon: data.icon,
                                title: data.success,
                                text: data.message
                            })
                        } else if (data.warning) {
                            Swal.fire({
                                icon: data.icon,
                                title: data.warning,
                                text: data.message
                            })
                        } else {
                            Swal.fire({
                                icon: data.icon,
                                title: data.error,
                                text: data.message
                            })
                        }
                    },
                    error: function(xhr, text, error) {
                        console.log(error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur !!',
                            text: 'Une erreur est survenue, reéssayer une autre fois'
                        })
                    }
                })
            }

        });
    }
    sendNotification()

})