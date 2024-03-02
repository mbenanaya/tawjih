

<?php
  include('./controllers/session-admin.php'); 
  require_once './controllers/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('./views/assets/inlcudes/head-dashboard.php');  ?>
   <!--  -->
   <title>Liste-article</title>
   <style>
    body{
      background-color: #eee;
    }
    .card-img-top{
      height: 200px; /* ou une autre valeur que vous préférez */
    object-fit: cover;
    }
    .no-article {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
  }

  .no-article p {
    font-size: 2rem;
    text-align: center;
    color: #888;
  }
   </style>
</head>

<body>
  
<header id="header" class="header fixed-top d-flex align-items-center" style='background-color: #2a5eb8;'>
      <?php include('./views/assets/inlcudes/header-admin.php');  ?>
   </header>
   <aside id="sidebar" class="sidebar">
      <?php include('./views/assets/inlcudes/sidebar-admin.php'); ?>
   </aside>
   <!-- MAIN -->
   <main id="main" class="main">

   <div class="container my-5">
   <div class="pagetitle bg-white px-3 pb-2 pt-3 mb-5 d-flex align-items-center">
      <!-- <h1>Dashboard</h1> -->
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./dashboard-admin">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
         </ol>
      </nav>
   </div>
      
   <div class="container">
  <?php
  $auth = new Auth(); // Instanciation de la classe Auth
  $articles = $auth->get_article(); 

  if (empty($articles)) {
    echo "<div class='no-article'>
    <p>Pas de concours pour le moment</p>
  </div>";
  } else {
  ?>
    <div class="row">
      <?php foreach ($articles as $article) { ?>
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          <img src="./uploads/articles/images/<?php echo $article['image']; ?>" class="card-img-top" alt="" id="image-">
          <div class="card-body">
            <h5 class="card-title"><a href="read-concours-admin?id=<?php echo $article['id']; ?>"><?php echo $article['titre_article']; ?></a></h5>
            <a href="#" class="btn btn-primary editBtn" data-toggle="modal" data-target="#modifier-modal" data-article-id="<?php echo $article['id']; ?>" data-article-title="<?php echo $article['titre_article']; ?>"><i class="fas fa-edit" id="<?php echo $article['id']; ?>"></i> Modifier</a>
            <a href="#" class="btn btn-danger deleteBtn" data-article-id="<?php echo $article['id']; ?>"><i class="fas fa-trash"></i> Supprimer</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  <?php } ?>
</div>

    </div>
    
    <!-- Popup de modification -->
    <!-- <div class="modal fade" id="modifier-modal" tabindex="-1" aria-labelledby="modifier-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifier-modal-label">Modifier l'article</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="edit-article-form" enctype="multipart/form-data">
          <input type="hidden" name="article_id" id="article_id">
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="modifier-titre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="modifier-titre" name="modifier-titre">
              </div>
              <div class="mb-3">
                <img id="current-image" src="" alt="Image actuelle" style="max-width: 100px;">


                <input type="file" class="form-control" id="modifier-image" name="modifier-image">
                <span id="image"></span>
              </div>
              <div class="mb-3">
                <label for="modifier-tags" class="form-label">titre concours  :</label>
                <input type="text" class="form-control" id="modifier-concours" name="modifier-concours">
              </div>
            </div>
            <div class="col-md-4">
            <div class="mb-3">
                <label for="modifier-description" class="form-label">Pdf :</label>
                <input  type="file" class="form-control" id="modifier-pdf" name="modifier-pdf">
                <input type="text" class="form-control" id="modifier-pdf-nom" readonly>


              </div>
              <div class="mb-3">
                <label for="modifier-description" class="form-label">Audio :</label>
                <input  type="file" class="form-control" id="modifier-audio" name="modifier-audio">
                <input type="text" class="form-control" id="modifier-audio-nom" readonly>


              </div>
              <div class="mb-3">
                <label for="modifier-description" class="form-label">Video :</label>
                <input type="file" class="form-control" id="modifier-video" name="modifier-video" >
                <input type="text" class="form-control" id="modifier-video-nom" readonly>


              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="modifier-tags" class="form-label">date concours :</label>
                <input type="text" class="form-control" id="date-concours" name="date-concours">
              </div>
              <div class="mb-3">
                    <label for="lien_video" class="form-label">Description:</label>
                    <textarea id="modifier-description" name="modifier-description"></textarea>
                </div>
              <div class="mb-3">
                <label for="modifier-tags" class="form-label">Lien ecole : </label>
                <input type="text" class="form-control" id="lien-ecole" name="lien-ecole">
              </div>
            
   </div>
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="modification-btn" data-article-id="">Enregistrer</button>
      </div>
    </div>
  </div>
</div> -->
<div class="modal fade" id="modifier-modal" tabindex="-1" aria-labelledby="modifier-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifier-modal-label">Modifier l'article</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="edit-article-form" enctype="multipart/form-data">
          <input type="hidden" name="article_id" id="article_id">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="modifier-titre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="modifier-titre" name="modifier-titre">
              </div>
              <div class="mb-3">
                <label for="modifier-tags" class="form-label">Titre concours :</label>
                <input type="text" class="form-control" id="modifier-concours" name="modifier-concours">
              </div>
              <div class="mb-3">
                <label for="modifier-image" class="form-label">Image actuelle :</label>
                <img id="current-image" src="" alt="Image actuelle" style="max-width: 100px;">
              </div>
              <div class="mb-3">
                <label for="modifier-image" class="form-label">Modifier l'image :</label>
                <input type="file" class="form-control" id="modifier-image" name="modifier-image">
                <span id="image"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="modifier-pdf" class="form-label">PDF :</label>
                <input type="file" class="form-control" id="modifier-pdf" name="modifier-pdf">
                <input type="text" class="form-control" id="modifier-pdf-nom" readonly>
              </div>
              <div class="mb-3">
                <label for="modifier-audio" class="form-label">Audio :</label>
                <input type="file" class="form-control" id="modifier-audio" name="modifier-audio">
                <input type="text" class="form-control" id="modifier-audio-nom" readonly>
              </div>
              <div class="mb-3">
                <label for="modifier-video" class="form-label">Vidéo :</label>
                <input type="file" class="form-control" id="modifier-video" name="modifier-video">
                <input type="text" class="form-control" id="modifier-video-nom" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label for="modifier-description" class="form-label">Description :</label>
                <textarea id="modifier-description" class="form-control" name="modifier-description" rows="8"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
            <div class="mb-3">
                <label for="date-concours" class="form-label">Date concours :</label>
                <input type="text" class="form-control" id="date-concours" name="date-concours">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="lien-ecole" class="form-label">Lien école :</label>
                <input type="text" class="form-control" id="lien-ecole" name="lien-ecole">
              </div>
            </div>
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="modification-btn" data-article-id="">Enregistrer</button>
      </div>
    </div>
  </div>
</div>

             





         <!-- CHAT BOX -->

   </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>


   <!-- MAIN FOR DASHBOARD -->
   <script src="./views/assets/js/main.js"></script>

   <?php include('./views/assets/inlcudes/script-dashboard-admin.php'); ?>


   <script>
  $(document).ready(function() {
    $('#modifier-description').summernote({
            height: 300, // Hauteur de l'éditeur
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
              ] // Configuration de la barre d'outils
        });
  // Récupération de l'article à modifier et remplissage des champs du formulaire
$('.editBtn').click(function() {

    var article_id = $(this).data('article-id');
    $('#modification-btn').data('article-id', article_id);
    $('#article_id').val(article_id);
    $.ajax({
      url: 'controllers/process.php',
      type: 'POST',
      data: {id: article_id},
      success: function(response) {
        var data = JSON.parse(response);
        console.log(data.description);
        $('#id').val(data.id_article);
        $('#modifier-titre').val(data.titre_article);
        $('#image').val(data.image);
        $('#current-image').attr('src', 'uploads/articles/images/' + data.image);

        $("#modifier-concours").val(data.titre_concours);
        $("#date-concours").val(data.date_concours); 
        var description = data.description.replace(/<[^>]*>/g, '');
        $('#modifier-description').summernote('code', $('<div>').html(description).text());
        $("#lien-ecole").val(data.lien_ecole); 
        // Afficher les noms de fichiers PDF, audio et vidéo
$('#modifier-pdf-nom').val(data.pdf);
$('#modifier-audio-nom').val(data.audio);
$('#modifier-video-nom').val(data.video);

      }
    });    
  });
  $("#modification-btn").click(function(e){
  var article_id = $('#modification-btn').data('article-id');
  var form_data = new FormData($("#edit-article-form")[0]);
  form_data.append('action', 'update_note');
  form_data.append('article_id', article_id);
  if($("#edit-article-form")[0].checkValidity()){
    e.preventDefault();
    $.ajax({
      url:'controllers/process.php',
      method:'post',
      data: form_data,
      contentType: false,
      processData: false,
      success:function(response){
        console.log(response);
        Swal.fire({
          title:"Article mis a jour avec succès",
          type:'success',
        });
        location.reload();
        
      }
    });
  }
});

  
  /* $("#modification-btn").click(function(e){
    var article_id = $('#modification-btn').data('article-id');
    if($("#edit-article-form")[0].checkValidity()){
      e.preventDefault();
      $.ajax({
        url:'controllers/process.php',
        method:'post',
        var formData = new FormData($("#edit-article-form")[0]);
        formData.append('action', 'update_note');
        formData.append('article_id', article_id);
        data: formData,

        success:function(response){
          console.log(response);
          Swal.fire({
            title:"Note Update successufuly",
            type:'success',
          });
          location.reload(); 
        
        }
      });
    }
  }); */
  // Suppression de l'article
  $('.deleteBtn').click(function() {
    var article_id = $(this).data('article-id');
    Swal.fire({
      title: 'Êtes-vous sûr de vouloir supprimer cet article ?',
      text: 'Cette action est irréversible.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Oui, supprimer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: 'controllers/process.php',
          method: 'post',
          data: {id: article_id, action: 'delete_article'},
          success: function(response) {
            console.log(response);
            Swal.fire({
              title: 'Article supprimé avec succès !',
              type: 'success',
            });
            location.reload(); 
          }
        });
      }
    });
  });
});


  
  
  // Envoi du formulaire pour mettre à jour l'article
  /* $('#enregistrer-modification-btn').click(function(e){
    e.preventDefault();
    $.ajax({
      url: 'controllers/process.php',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response){
        if(response === 'success'){
          alert("yes");
        }else{
          alert("no");
        }
        $('#modifier-modal').modal('hide');
        location.reload();
      }
    });
  }); */


   </script>

</body>

</html>