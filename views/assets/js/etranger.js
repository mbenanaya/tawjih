$(function() {

    function showCountries() {
        $.ajax({
            type: "post",
            url: "./controllers/PaysController.php",
            data: { action: "getAllCountries" },
            dataType: "html",
            success: function(data) {
                $("#countries").html(data)
                console.log("done")
            },
            error: function(xhr, text, error) {
                console.log(error)
            }
        })
    }
    showCountries();
})