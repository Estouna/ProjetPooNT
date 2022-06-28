<?php

namespace App\Core;

use App\Controllers\MainController;

/**
 * Routeur principal
 */
class Main
{
    public function start()
    {
        // Récupère l'URL "/public/annonces/details/a/b/c/"
        $uri = $_SERVER['REQUEST_URI'];

        // Vérifie que $uri n'est pas vide et se termine par un /
        if (!empty($uri) && $uri != '/' && $uri[-1] === '/') {

            // Enlève le dernier /
            $uri = substr($uri, 0, -1);

            // Code de redirection permanente
            http_response_code(301);

            //Redirige vers l'URL sans /
            header('Location: ' . $uri);
            exit;
        }

        // Sépare les paramètres dans un tableau
        $params = explode('/', $_GET['p']);

        // Vérifie qu'au moins un paramètre existe
        if ($params[0] != '') {

            // Récupère le 1er paramètre qui est le nom du controller à instancier (namespace complet)
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller';

            // Instancie le controller
            $controller = new $controller();

            // Récupère le 2e paramètre qui est le nom de la méthode
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if (method_exists($controller, $action)) {

                // S'il reste des paramètres on les passe à la méthode 
                // call_user_func_array() permet d'envoyer une fonction (ici [$controller, $action]) et de passer en plus un tableau
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            } else {

                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {

            // Controller par défaut
            $controller = new MainController;
            $controller->index();
        }
    }
}
