$(function() {

    function getTotalCounts() {
        $.ajax({
            type: "post",
            url: "./controllers/StaticsController.php",
            data: { action: "getStatics" },
            dataType: "json",
            success: function(data) {
                $("#studTotalByDay").text(data.studsCount)
                $("#studTotalByDuration").text(data.studsCount)
                $("#concTotalByDay").text(data.concoursCount)
                $("#concTotalByDuration").text(data.concoursCount)
            },
            error: function(xhr, textStatus, error) {
                console.log(error)
            }
        })
    }
    getTotalCounts()

    function getTodayCounts() {
        $.ajax({
            type: "post",
            url: "./controllers/StaticsController.php",
            data: { action: "getTodaysStatics" },
            dataType: "json",
            success: function(data) {
                $("#studNumbByDay").text(data.studsTodayCount)
                $("#studNumbByDuration").text(data.studsTodayCount)
                $("#concNumbByDay").text(data.concoursTodayCount)
                $("#concNumbByDuration").text(data.concoursTodayCount)
            },
            error: function(xhr, textStatus, error) {
                console.log(error)
            }
        })
    }
    getTodayCounts()

    function filterCountsByDay() {

        var filterByDay = $("#filterByDay");
        var filterByDayForm = $("#filterByDayForm");
        filterByDayForm
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    datefil: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    var caption = filterByDay.html();

                    $.ajax({
                        url: './controllers/StaticsController.php',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            $("#studNumbByDay").text(data.studsCountByDay)
                            $("#concNumbByDay").text(data.concoursCountByDay)

                        },
                        error: function(xhr, textStatus, errorThrown) {
                            // console.error(textStatus, errorThrown);
                            Swal.fire({
                                icon: "error",
                                title: "Error !!",
                                text: "Une erreur est survenue",
                            });
                            filterByDay.attr("disabled", false).html(caption);
                        },
                    });
                },
            });
        $("#filterByDayForm").trigger("reset");
    }
    filterCountsByDay()

    function filterCountsByDuration() {

        var submitButton = $("#filterByDuration");
        var staticsForm = $("#staticsForm");
        staticsForm
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    datedb: {
                        required: true,
                    },
                    datefin: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    var caption = submitButton.html();
                    var dd = $("#datedb").val()
                    var df = $("#datefin").val()

                    $.ajax({
                        url: './controllers/StaticsController.php',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            $("#studNumbByDuration").text(data.studsCountByDuration)
                            $("#concNumbByDuration").text(data.concoursCountByDuration)

                        },
                        error: function(xhr, textStatus, errorThrown) {
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
        $("#staticsForm").trigger("reset");
    }
    filterCountsByDuration()

    function getTodaysCountForPack(packId, todaysData) {
        var count = 0;
        $.each(todaysData, function(index, item) {
            if (item.idpack === packId) {
                count = item.todayStudsNumber;
                return false;
            }
        });
        return count;
    }

    function getStudentsCountByPack() {

        $.ajax({
            type: "post",
            url: "./controllers/StaticsController.php",
            data: { action: "getStudentsCountByPack" },
            dataType: "html",
            dataType: "json",
            success: function(data) {
                console.log(data)
                var output = ''
                $.each(data.result, function(index, item) {
                    var todaysCount = getTodaysCountForPack(item.idpack, data.todaysData);
                    output += '<div class="col-md-4 col-xl-3">';
                    output += '<div class="card order-card" style="background-color: ' + item.color + ';">';
                    output += '<div class="card-block">';
                    output += '<h6 class="mb-4">' + item.pack + '</h6>';
                    output += '<h2 class="text-right"><i class="fa-solid fa-users f-left"></i><span class="todaysCount">' + todaysCount + '</span></h2>';
                    output += '<p class="mt-3 mb-1 fs-5">Nombre total<span class="f-right" id="packsNumber">' + item.studsNumber + '</span></p>';
                    output += '</div></div></div>';
                });

                $("#counts").html(output);
            },
            error: function(xhr, textStatus, error) {
                console.log(error)
            }
        })
    }
    getStudentsCountByPack()

    function filterPacksStudsCountsByDuration() {
        var submitButton = $("#filterPacksByDuration");
        var staticsForm = $("#packsForm");

        staticsForm.submit(function(e) {
            e.preventDefault();
        }).validate({
            rules: {
                dateDbP: {
                    required: true,
                },
                dateFinp: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                var formData = new FormData($(form)[0]);
                var caption = submitButton.html();

                $.ajax({
                    url: './controllers/StaticsController.php',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        var output = ''
                        $.each(data, function() {
                            output += '<div class="col-md-4 col-xl-3">'
                            output += '<div class="card order-card" style="background-color: ' + this.color + ';">'
                            output += '<div class="card-block">'
                            output += '<h6 class="mb-4">' + this.pack + '</h6>'
                            output += '<h2 class="text-right"><i class="fa-solid fa-users f-left"></i><span>' + this.studsNumber + '</span></h2>'
                            output += '<p class="mt-3 mb-1 fs-5">Nombre total<span class="f-right" id="packsNumber">' + this.studsNumber + '</span></p>'
                            output += '</div></div></div>'
                        })

                        $("#counts").empty()
                        $("#counts").html(output)
                    },
                    error: function(xhr, textStatus, errorThrown) {
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
        $("#packsForm").trigger("reset");
    }
    filterPacksStudsCountsByDuration()

})