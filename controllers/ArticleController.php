<?php

require_once '../models/Article.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


class ArticleController
{
	private $article;

    public function __construct()
    {
        $this->article = new Article;
    }

    public function showArticles($idBac)
    {
        $output = '';
        $articles = $this->article->getAllArticles($idBac);
        
        if (empty($articles)) {
            $output .= '<div class="text-center fs-1 fw-semibold mt-5">لا توجد مباريات</div>';
        } else {
            foreach ($articles as $article) {
                $id = $article['id'];
                $titre = $article['titre_article'];
                $image = $article['image'];
                $dateCon = date('d-m-Y', strtotime($article['date_concours']));

                $output .= '
                     <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                         <div class="card h-100">
                             <a href="article-concours?id='.$id.'" class="image-article">
                                 <img src="'."./uploads/articles/images/".$image.'" alt="'.$titre.'" class="card-img-top" height="250px">
                             </a>
                             <div class="card-body d-flex flex-column">
                                 <a href="article-concours?id='.$id.'" class="text-center pt-3 pb-3 title-article">
                                     '.$titre.'
                                 </a>
                                 <span class="text-center" style="color: red"> <strong> اخر أجل : '.$dateCon.'</strong></span>
                             </div>
                         </div>
                     </div>
                 ';
            }
        }
        echo $output;
    }


    public function getArticleById($id)
    {
        $article = [];
        $row = $this->article->getArticle($id);
        $article = [
            'titre_article' => $row['titre_article'],
            'titre_concours' => $row['titre_concours'],
            'image' => $row['image'],
            'pdf' => $row['pdf'],
            'audio' => $row['audio'],
            'video' => $row['video'],
            'description' => $row['description'],
            'lien_ecole' => $row['lien_ecole'],            
            'date_concours' => $row['date_concours'],
            'created_at' => $row['created_at'],
            'lien_video' => $row['lien_video'],
        ];

        header('Content-Type: application/json'); 
        echo json_encode($article); 
    }
}

$ar = new ArticleController();

if (isset($_POST['idBac']) && isset($_POST['action']) && $_POST['action'] == 'showArticles') {
    $id = $_POST['idBac'];
    $ar->showArticles($id);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $ar->getArticleById($id);
}

// $ar->getArticleById(2);