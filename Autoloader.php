<?php

namespace App;

class Autoloader
{

    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        // On récupère dans $class la totalité du namespace de la classe concernée (par exemple "App\Client\Compte")
        // 1 On retire App\ (Client\Compte)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        // 2 On remplace les \ par des / (Client/Compte)
        $class = str_replace('\\', '/', $class);

        // 3 On charge avec le chemin, le /, $class, .php et on vérifie si le fichier existe pour éviter une erreur de chargement (il y aura une erreur mais seulement parce que la classe n'existe pas)
        $fichier = __DIR__ . '/' . $class . '.php';

        if (file_exists($fichier)) {
            require_once $fichier;
        }
    }
}
