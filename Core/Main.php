<?php

namespace App\Core;

use App\Controllers\MainController;

class Main
{
    public function start()
    {
        // Récupère l'URL "/public/annonces/details/a/b/c/"
       $uri = $_SERVER['REQUEST_URI'];

       // Vérifie que $uri n'est pas vide et se termine par un /
       if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){

            // Enlève le dernier /
            $uri = substr($uri, 0, -1);

            // Code de redirection permanente
            http_response_code(301);

            // Redirige vers l'URL sans /
            header('Location: '.$uri);
            exit;
       }

       // Sépare les paramètres dans un tableau
       $params = explode('/', $_GET['p']);

       // Vérifie qu'au moins un paramètre existe
       if($params[0] != ''){
           var_dump($params);
       }else{
            $controller = new MainController;
            $controller->index();
       }
    }
}