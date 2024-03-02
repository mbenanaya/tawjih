<ul class="sidebar-nav position-relative h-100" id="sidebar-nav">
   <li class="nav-item">
      <a class="nav-link " href="./dashboard-admin"> <i class="bi bi-grid"></i> <span>Home</span> </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#article" data-bs-toggle="collapse" href="#"><i class="far fa-file-alt"></i><span class='me-4 d-block'>Article</span> <i
            class="bi bi-chevron-down ms-auto"></i> </a>
      <ul id="article" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         <li> <a href="<?php echo BASE_URL?>/ajouter-article"> <i class="bi bi-circle"></i><span>Ajouter un Article </span> </a>
         </li>
         <li> <a href="<?php echo BASE_URL?>/liste-article"> <i class="bi bi-circle"></i><span>Liste des Articles</span> </a></li>
      </ul>
   </li>
   <li class='nav-item'>
               <a href="./crud-students" class='nav-link collapsed'>
               <i class="fa-solid fa-folder"></i>
                Étudiants
               </a>
   </li>
   <li class='nav-item'>
      <a href="<?php echo BASE_URL ?>/student-depot" class='nav-link collapsed'>
      <i class="fa-solid fa-folder"></i>
         Recus étudiants
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" href="./modification-request"><i class="fas fa-edit"></i><span>Demande de modification de données</span> </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/Demandes-dinscription"><i class="fa-solid fa-code-pull-request"></i><span>Demandes d'inscription</span> </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/envoyer-notification"><i class="fa-solid fa-bell" style="font-size: 19px"></i></i><span>Envoyer notification</span> </a>
   </li>
   <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="#">
      <i class="fa-brands fa-rocketchat"></i>
      <span>Messages</span> </a>
   </li> -->
   <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#"><i
            class="fa-solid fa-gear"></i><span class='me-4 d-block'>Paramétrage</span> <i
            class="bi bi-chevron-down ms-auto"></i> </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         <li> <a href="<?php echo BASE_URL?>/website"> <i class="bi bi-circle"></i><span>Paramètres de site web</span> </a>
         </li>
         <li> <a href="<?php echo BASE_URL?>/users"> <i class="bi bi-circle"></i><span>Utilisateurs</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/packs"> <i class="bi bi-circle"></i><span>Packs</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/etudes-a-letranger"> <i class="bi bi-circle"></i><span>Études à l'étranger</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/crud-bac"> <i class="bi bi-circle"></i><span>Bacs</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/crud-region"> <i class="bi bi-circle"></i><span>Régions</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/crud-city"> <i class="bi bi-circle"></i><span>Villes</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/crud-lycee"> <i class="bi bi-circle"></i><span>Lycée</span> </a></li>
         <li> <a href="<?php echo BASE_URL?>/crud-establishment"> <i class="bi bi-circle"></i><span>Établissements</span> </a></li>
      </ul>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/crud-stripe">
      <i class="fa-brands fa-cc-stripe" style="font-size: 20px;"></i>
      <span>Stripe Payment</span> </a>
   </li>
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/whatsapp">
      <i class="fa-brands fa-whatsapp" style="font-size: 20px;"></i>
      <span>Whatsapp</span> </a>
   </li>   
   <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo BASE_URL ?>/commentaires">
      <i class="fa-solid fa-comment" style="font-size: 20px;"></i>
      <span>Commentaires</span> </a>
   </li>
   
   <!-- <li class="nav-item position-absolute w-100" style="bottom: 1rem;"> 
      <a class="nav-link collapsed" href="./controllers/logout-admin.php"> 
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span> 
      </a>
   </li> -->
</ul>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>