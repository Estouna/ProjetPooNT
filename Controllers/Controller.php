<?php

namespace App\Controllers;

/**
 * Contrôleur principal
 */
abstract class Controller
{
    /**
     * Renvoi les informations à une vue pour l'affichage
     *
     * @param string $fichier
     * @param array $donnees
     * @return void
     */
    public function render(string $fichier, array $donnees = [], string $template = 'default')
    {
        // Extrait le contenu de $donnees
        extract($donnees);

        // Démarre le buffer de sortie, à partir de ce point toute sortie est conservée en mémoire
        ob_start();

        // Chemin vers la vue mis en mémoire
        require_once ROOT . '/Views/' . $fichier . '.php';

        // Transfère le buffer dans $content
        $content = ob_get_clean();

        // Template de la page
        require_once ROOT . '/Views/' . $template . '.php';
    }
}
