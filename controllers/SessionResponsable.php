<?php

if (!isset($_SESSION['RESPONSABLEINFO']['emailRes']) &&  
         !isset($_SESSION['RESPONSABLEINFO']['idRes_gen']) && 
            !isset($_SESSION['RESPONSABLEINFO']['typeUser'])) {
               header('Location: '.BASE_URL.'/login-responsable');
}



?>