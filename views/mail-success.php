<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png"
    type="image/x-icon">
    <title>mail success</title>
</head>
<style>
    body {
        margin-top: 20px;
    }

    .mail-seccess {
        text-align: center;
        background: #fff;
        border-top: 1px solid #eee;
    }

    .mail-seccess .success-inner {
        display: inline-block;
    }

    .mail-seccess .success-inner h1 {
        font-size: 100px;
        text-shadow: 3px 5px 2px #3333;
        color: #006DFE;
        font-weight: 700;
    }

    .mail-seccess .success-inner h1 span {
        display: block;
        font-size: 25px;
        color: #333;
        font-weight: 600;
        text-shadow: none;
        margin-top: 20px;
    }

    .mail-seccess .success-inner p {
        padding: 20px 15px;
    }

    .mail-seccess .success-inner .btn {
        color: #fff;
    }
</style>

<body>
    <section class="mail-seccess section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <img src="./views/assets/images/slide/8dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png" style="height: 100px;width: 100px;">
                    <!-- Error Inner -->
                    <div class="success-inner">
                        <h1><i class="fa fa-envelope"></i><span>Votre e-mail envoyé avec succès !</span></h1>
                        <h1><span>!تم إرسال بريدك الإلكتروني بنجاح </span></h1>
                        <p dir='rtl'> تم استلام رسالتكم، شكرًا لكم على التواصل معنا. نود إعلامكم بأننا سنقوم بالرد عليكم في اقرب وقت . </p>
                        <a href="<?php echo BASE_URL ?>" class="btn btn-primary btn-lg">الصفحة الرئيسية</a>
                    </div>
                    <!--/ End Error Inner -->
                </div>
            </div>
        </div>
    </section>
</body>

</html>