
<?php
session_start();
// include './model/db.php';
include './boostrap.php';
require_once './autoload.php';



$home = new IndexController();


$pages = array('index',
                'se-connecter',
                'complete-profile',
                'dashboard-student',
                'profile',
                'contact-student',
                'concours',
                'videos',
                'recus-student',
                'dashboard-admin',
                'ajouter-article',
                'liste-article',
                'users',
                'create-user',
                'edit-user',
                'forget-password',
                'confirm-code',
                'admin',
                'mail-success',
                'change-password',
                'change-password-success',
                'website',
                'crud-bac',
                'crud-students',
                'crud-region',
                'crud-city',
                'establishments',
                'chat-with-student-or-admin',
                'chat-width-responsable','chat-admin-with-resp-or-std',
                'crud-lycee',
                'crud-establishment',
                'add-establishment',
                'update-establishment',
                'modification-request',
                'packs',
                'open-an-account','responsables',
                'edit-responsable',
                'create-responsable',
                'messages-responsable',
                'export',
                'etudes-a-letranger',
                'gestion-pays',
                'study-abroad',
                'pays',
                'whatsapp',
                'whats',
                'article-concours',
                'dashboard-responsable',
                'login-responsable',
                'Demandes-dinscription',
                'inscription-establishment',
                'ajouter-article-responsable',
                'liste-article-responsable',
                'crud-students-responsable',
                'export_students_reponsable',
                'envoyer-notification',
                'article-etranger',
                'create-commentaire',
                'commentaires',
                'inscription-establishment',
                'change-password-student',
                'student-depot',
                'recus-admin',
                'crud-stripe',
                'complete',
                'student-depot-responsable',                
                'inscription-establishment-resp',              
                'recus-resp',              
                'crud-establishment-resp',              
                'add-establishment-resp',              
                'update-establishment-resp',            
                'edit-responsable-resp',            
                'read-concours-admin',    
                'read-concours-resp',
            );
if (isset($_GET['page'])){
    if (in_array($_GET['page'],$pages)){
        $page = $_GET['page'];
        $home -> index($page);
    }else{
        http_response_code(404);
        include('./views/assets/inlcudes/not-found.php');
    }
}else{
    $home -> index('index');
}
