$(function() {
    url_string = window.location.href;
    url = new URL(url_string);
    var article_id = url.searchParams.get("id");

    $.ajax({
        type: "POST",
        url: "./controllers/ArticleEtrController.php",
        data: { article_id: article_id },
        dataType: 'json',
        success: function(data) {
            console.log('done')
            var titre = data.titre
            document.title = titre
            $('#titre').text(data.titre)
            $("#created_at").text(data.created_at)
            $("#article_image").attr('src', 'uploads/etranger/article/images/' + data.image)
            $('#description').html(data.descr)

            if (data.pdf) {
                var pdf = "uploads/etranger/article/pdfs/" + data.pdf
                pdfjsLib.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js'
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js'

                var pdfContainer = $('<div class="my-4"></div>').addClass('pdf-container')
                $('.wrapper').append(pdfContainer)

                pdfjsLib.getDocument({
                    url: pdf
                }).promise.then(function(pdf) {
                    var container = $('.pdf-container')[0]
                    var scale = 1.5

                    function renderPage(pageNum) {
                        pdf.getPage(pageNum).then(function(page) {
                            var viewport = page.getViewport({ scale: scale })
                            var canvas = document.createElement('canvas')
                            var context = canvas.getContext('2d')
                            canvas.className = 'pdf-canvas'
                            canvas.width = viewport.width
                            canvas.height = viewport.height
                            container.appendChild(canvas)
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            page.render(renderContext)
                            if (pageNum < pdf.numPages) {
                                renderPage(pageNum + 1)
                            }
                        });
                    }

                    renderPage(1)
                });
            }


            if (data.audio) {
                var audioElement = '<div id="div_audio" class="my-4">'
                audioElement += '<div class="ibox-title pt-4">'
                audioElement += '<h3 class="text-center fw-normal">كيفية التسجيل بصوت الموجه</h3><br><br>'
                audioElement += '</div>'
                audioElement += '<div class="text-center mt-1">'
                audioElement += '<audio id="audio" src="uploads/etranger/article/audios/' + data.audio + '" controls></audio>'
                audioElement += '</div> </div>'
                $('.wrapper').append(audioElement)
            }

            if (data.lien) {
                var lien = '<div class="d-sm-flex justify-content-center rounded my-5 subscriptions">'
                lien += '<a id="lien_ecole" href="' + data.lien + '" class="btn btn-danger w-50" target="_blanck">رابط التسجيل</a> </div>'
                $('.wrapper').append(lien)
            }

            if (data.video) {
                var videoElement = '<div id="div_video" class="my-4">'
                videoElement += '<div class="ibox-title pt-4">'
                videoElement += '<h3 class="text-center fw-normal">فيديو يوضح طريقة التسجيل</h3><br><br>'
                videoElement += '</div>'
                videoElement += '<div class="text-center mt-1" style="height: 300px">'
                videoElement += '<video id="video" src="uploads/etranger/article/videos/' + data.video + '" style="width: 100%" controls></video>'
                videoElement += '</div> </div>'
                $('.wrapper').append(videoElement)
            }

        },
        error: function(xhr, textStatus, error) {
            console.error(error);
        }
    });

    // var description = data.description_article.replace(/<[^>]*>/g, '');
    // $('#description').summernote('code', $('<div>').html(description).text())


    // $('#lien').append('<a href="'+data.lien+'" class="text-decoration-none" target="_blank">'+data.titre+'</a>');

});