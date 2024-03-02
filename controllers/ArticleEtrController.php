<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/ArticleEtr.php';

class ArticleEtrController
{
	public $ArticleEtr;

    public function __construct()
    {
        $this->ArticleEtr = new ArticleEtr;
    }

    public function addArticleEtr($titre, $description_article, $lien, $image, $pdf, $audio, $video, $id_pays)
    {
        $image_name = $image['name'];
        $tmp_image  = $image['tmp_name'];
        $pdf_name   = $pdf['name'];
        $tmp_pdf    = $pdf['tmp_name'];
        $audio_name = $audio['name'];
        $tmp_audio  = $audio['tmp_name'];
        $video_name = $video['name'];
        $tmp_video  = $video['tmp_name'];

        $full_img_path = '../uploads/etranger/article/images';
        $full_pdf_path = '../uploads/etranger/article/pdfs';
        $full_aud_path = '../uploads/etranger/article/audios';
        $full_vid_path = '../uploads/etranger/article/videos';

        $new_image_name = '';
        $new_pdf_name = '';
        $new_audio_name = '';
        $new_video_name = '';

        if (!empty($image_name)) {
            $time = date('ymdHis');
            $new_image_name = $time . $image_name;
            $pos_image = $full_img_path . '/' . $new_image_name;
            move_uploaded_file($tmp_image, $pos_image);
        }

        if (!empty($pdf_name)) {
            $time = date('ymdHis');
            $new_pdf_name = $time . $pdf_name;
            $pos_pdf = $full_pdf_path . '/' . $new_pdf_name;
            move_uploaded_file($tmp_pdf, $pos_pdf);
        }

        if (!empty($audio_name)) {
            $time = date('ymdHis');
            $new_audio_name = $time . $audio_name;
            $pos_audio = $full_aud_path . '/' . $new_audio_name;
            move_uploaded_file($tmp_audio, $pos_audio);
        }

        if (!empty($video_name)) {
            $time = date('ymdHis');
            $new_video_name = $time . $video_name;
            $pos_video = $full_vid_path . '/' . $new_video_name;
            move_uploaded_file($tmp_video, $pos_video);
        }

        $result = $this->ArticleEtr->addArticle($titre, $description_article, $lien, $new_image_name, $new_pdf_name, $new_audio_name, $new_video_name, $id_pays);

        if ($result === true) {
            $response = ['success' => true, 'message' => 'Article ajouté avec succès'];
        } else {
            $response = ['error' => true, 'message' => 'Une erreur est survenue !!'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function showArticles()
    {
        
        header('Content-Type: application/json');
        $output = '';
        $articles = $this->ArticleEtr->getAllArticles();
        
        if (empty($articles)) {
            $output .= '<div class="text-center fs-1 fw-semibold mt-5">لا توجد معلومات</div>';
            echo json_encode(array('message' => $output));
        } else {
            echo json_encode($articles);
        }
    }

    public function getarticlesNumber()
    {
        $count = $this->ArticleEtr->getarticlesNumber();
        $data = ['count' => $count];
        echo json_encode($data);
    }

    public function getArticleById($id)
    {
        header('Content-Type: application/json');
        $result = $this->ArticleEtr->getArticleById($id);
        echo json_encode($result);

    }

    public function getArticleToPage($id)
    {
        $row = $this->ArticleEtr->getArticleById($id);

        $article = [
            'titre' => $row['titre'],
            'descr' => $row['description_article'],
            'lien'  => $row['lien'],
            'image' => $row['image'],
            'pdf'   => $row['pdf'],
            'audio' => $row['audio'],
            'video' => $row['video'],
            'created_at' => date("d-m-Y", strtotime($row['created_at']))
        ];

        header('Content-Type: application/json');
        echo json_encode($article);
    }

    public function updateArticle($id, $titre, $description, $lien, $image, $pdf, $audio, $video) {

        $article = $this->ArticleEtr->getArticleById($id);

        $currentImage = $article['image'];
        $currentPdf   = $article['pdf'];
        $currentAudio = $article['audio'];
        $currentVideo = $article['video'];

        $artImgPath = '../uploads/etranger/article/images/';
        $artPdfPath = '../uploads/etranger/article/pdfs/';
        $artAudPath = '../uploads/etranger/article/audios/';
        $artVidPath = '../uploads/etranger/article/videos/';

        $new_image_name = $currentImage;
        $new_pdf_name   = $currentPdf;
        $new_audio_name = $currentAudio;
        $new_video_name = $currentVideo;

        $time = date('ymdHis');

        if (!empty($image['name']) && !empty($image['tmp_name'])) {
            $new_image_name = $time . $image['name'];
            $pos_image = $artImgPath . $new_image_name;
            move_uploaded_file($image['tmp_name'], $pos_image);
            if (!empty($currentImage) && file_exists($artImgPath . $currentImage)) {
                unlink($artImgPath . $currentImage);
            }
        }

        if (!empty($pdf['name']) && !empty($pdf['tmp_name'])) {
            $new_pdf_name = $time . $pdf['name'];
            $pos_pdf = $artPdfPath . $new_pdf_name;
            move_uploaded_file($pdf['tmp_name'], $pos_pdf);
            if (!empty($currentPdf) && file_exists($artPdfPath . $currentPdf)) {
                unlink($artPdfPath . $currentPdf);
            }
        }

        if (!empty($audio['name']) && !empty($audio['tmp_name'])) {
            $new_audio_name = $time . $audio['name'];
            $pos_audio = $artAudPath . $new_audio_name;
            move_uploaded_file($audio['tmp_name'], $pos_audio);
            if (!empty($currentAudio) && file_exists($artAudPath . $currentAudio)) {
                unlink($artAudPath . $currentAudio);
            }
        }

        if (!empty($video['name']) && !empty($video['tmp_name'])) {
            $new_video_name = $time . $video['name'];
            $pos_video = $artVidPath . $new_video_name;
            move_uploaded_file($video['tmp_name'], $pos_video);
            if (!empty($currentVideo) && file_exists($artVidPath . $currentVideo)) {
                unlink($artVidPath . $currentVideo);
            }
        }

        $update = $this->ArticleEtr->updateArticle($id, $titre, $description, $lien, $new_image_name, $new_pdf_name, $new_audio_name, $new_video_name);


        if ($update === true) {
            $response = ['success' => true, 'message' => 'L\'article a été mis à jour avec succès.'];
        } else {
            $response = ['error' => true, 'message' => 'Une erreur est survenue !!'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }

    public function deleteArticle($idArticleEtr) {

        $image = $this->ArticleEtr->getArticleById($idArticleEtr)['image'];
        $pdf   = $this->ArticleEtr->getArticleById($idArticleEtr)['pdf'];
        $audio = $this->ArticleEtr->getArticleById($idArticleEtr)['audio'];
        $video = $this->ArticleEtr->getArticleById($idArticleEtr)['video'];

        $deleted = $this->ArticleEtr->deleteArticle($idArticleEtr);

        if (!empty($image) && $image !== null) {
            $image_path = '../uploads/etranger/article/images/';
            $articleImagePath = $image_path . $image;
            if (file_exists($articleImagePath)) {
                $imageRemoved = unlink($articleImagePath);
            }
        }

        if (!empty($pdf) && $pdf !== null) {
            $pdf_path = '../uploads/etranger/article/pdfs/';
            $articlePdfPath = $pdf_path . $pdf;
            if (file_exists($articlePdfPath)) {
                $pdfRemoved = unlink($articlePdfPath);
            }
        }

        if (!empty($audio) && $audio !== null) {
            $audio_path = '../uploads/etranger/article/audios/';
            $articleAudioPath = $audio_path . $audio;
            if (file_exists($articleAudioPath)) {
                $audioRemoved = unlink($articleAudioPath);
            }
        }

        if (!empty($video) && $video !== null) {
            $video_path = '../uploads/etranger/article/videos/';
            $articleVideoPath = $video_path . $video;
            if (file_exists($articleVideoPath)) {
                $videoRemoved = unlink($articleVideoPath);
            }
        }

        if ($deleted === true) {
            $response = ['success' => true, 'message' => 'L\'article supprimé avec succès.'];
        } else {
            $response = ['error' => true, 'message' => 'Une erreur est survenue !!'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getArticlesByCountry($id)
    {
        $output = '';
        $articles = $this->ArticleEtr->getArticlesByCountry($id);
        
        if (empty($articles)) {
            $output .= '<div class="text-center fs-1 fw-semibold mt-5">لا توجد معلومات</div>';
        } else {
            foreach ($articles as $article) {
                $id = $article['id'];
                $titre     = $article['titre'];
                $description_article   = $article['description_article'];
                $lien   = $article['lien'];
                $image = $article['PaysImg'];

                $output .= '
                    <a class="art_cont row my-5 rounded-2 text-decoration-none text-black" href="./article-etranger?id='.$id.'">
                        <div class="col-10 px-0 d-flex flex-column justify-content-center p-4">
                            <h3 class="text-center text-black fw-normal">'.$titre.'</h3>
                        </div>
                        <div class="col-2 px-0"> <img src="uploads/etranger/pays/'.$image.'" style="width: 100%;height: 100%;"> </div>
                    </a>
                ';
            }
        }
        echo $output;
    }

    public function validation($data){
        $data= trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

$artEtrContr = new ArticleEtrController;

if (isset($_POST['addNewArt'])) {
    $titre   = $artEtrContr->validation($_POST['titre']);
    $descrip = $_POST['description'];
    $lien    = $artEtrContr->validation($_POST['lien']);
    $id_pays = $_POST['CountryName'];
    $image   = $_FILES['image'];
    $pdf     = $_FILES['pdf'];
    $audio   = $_FILES['audio'];
    $video   = $_FILES['video'];

    $artEtrContr->addArticleEtr($titre, $descrip, $lien, $image, $pdf, $audio, $video, $id_pays);
}

if (isset($_POST['action']) && $_POST['action'] == 'showArticles') {
	$artEtrContr->showArticles();
}

if (isset($_POST['action']) && $_POST['action'] == 'getCount') {
    $artEtrContr->getarticlesNumber();
}

if (isset($_POST['idUpdate']) && isset($_POST['action']) && $_POST['action'] == 'getArticleById') {
    $idUpdate = $_POST['idUpdate'];
    $artEtrContr->getArticleById($idUpdate);
}

if (isset($_POST['updArticle'])) {
    $idUpdate = $_POST['idUpdate'];
    $titre = $artEtrContr->validation($_POST['titreUpdate']);
    $descr = $_POST['descriptionUpdate'];
    $lien = $artEtrContr->validation($_POST['lienUpdate']);

    $image   = $_FILES['imageUpd'];
    $pdf     = $_FILES['pdfUpd'];
    $audio   = $_FILES['audioUpd'];
    $video   = $_FILES['videoUpd'];

    $artEtrContr->updateArticle($idUpdate, $titre, $descr, $lien, $image, $pdf, $audio, $video);
}

if (isset($_POST['idDelete']) && isset($_POST['action']) && $_POST['action'] == 'deleteArticle') {
    $idDelete = $_POST['idDelete'];
    $artEtrContr->deleteArticle($idDelete);
}

if (isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'getArticlesByCountry') {
    $id = $_POST['id'];
    $artEtrContr->getArticlesByCountry($id);
}

if (isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    $artEtrContr->getArticleToPage($article_id);
}