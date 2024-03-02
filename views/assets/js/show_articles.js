$(function () {
    
    var idBac = $('#idBac').val();

    function showArticles(){
        $.ajax({
            type: "post",
            url: "./controllers/ArticleController.php",
            data: { idBac: idBac, action: "showArticles" },
            dataType: "html",
            success: function (response) {
                $("#cards-articles").html(response);
                console.log("article showed")
            },
            error: function (xhr, text, error) {
                console.log(error)
            }
        });
    }

    showArticles();

    setInterval(function(){ 
        showArticles();
    }, 500000);

})