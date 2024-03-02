<ul class="sidebar-nav position-relative h-100" id="sidebar-nav">
   <li class="nav-item">
      <a class="nav-link " href="./dashboard-responsable"> <i class="bi bi-grid"></i> <span>Home</span> </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#article" data-bs-toggle="collapse" href="#"><i class="far fa-file-alt"></i><span class='me-4 d-block'>Article</span> <i
            class="bi bi-chevron-down ms-auto"></i> </a>
      <ul id="article" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         <li> <a href="<?php echo BASE_URL?>/ajouter-article-responsable"> <i class="bi bi-circle"></i><span>Ajouter un Article </span> </a>
         </li>
         <li> <a href="<?php echo BASE_URL?>/liste-article-responsable"> <i class="bi bi-circle"></i><span>Liste des Articles</span> </a></li>
      </ul>
   </li>
   <li class='nav-item'>
               <a href="<?php echo BASE_URL?>/crud-students-responsable" class='nav-link collapsed'>
               <i class="fa-solid fa-folder"></i>
               Étudiants
               </a>
   </li>
   <li class='nav-item'>
      <a href="<?php echo BASE_URL ?>/student-depot-responsable" class='nav-link collapsed'>
      <i class="fa-solid fa-folder"></i>
       Recus étudiants
      </a>
   </li>   
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/messages-responsable">
      <i class="fa-brands fa-rocketchat"></i>
      <span>Messages</span> </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/crud-establishment-resp">
      <i class="fa-solid fa-school"></i>
      <span>Établissements</span> </a>
   </li>
      
</ul>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>