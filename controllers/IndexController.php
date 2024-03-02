
<?php

class IndexController
{
    public function index($page){
        include 'views/'.$page.'.php';
    }
}

?>