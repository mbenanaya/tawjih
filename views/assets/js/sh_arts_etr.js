$(function() {
    url_string = window.location.href;
    url = new URL(url_string);
    var id = url.searchParams.get("id");
    console.log("your id is " + id)

    $.ajax({
        url: './controllers/PaysController.php',
        type: "post",
        data: {
            id: id,
            action: "getPayName"
        },
        dataType: "json",
        success: function(data) {
            console.log(data)
            var pageTitle = 'الدراسة في ' + data
            document.title = pageTitle;
        },
        error: function(xhr, textStatus, error) {
            console.log(error)
        }
    })

    $.ajax({
        url: './controllers/ArticleEtrController.php',
        type: "post",
        data: {
            id: id,
            action: "getArticlesByCountry"
        },
        dataType: "html",
        success: function(data) {
            console.log('articles done')
            $('#articlesContainer').html(data)
        },
        error: function(xhr, textStatus, error) {
            console.log(error)
        }
    })
})