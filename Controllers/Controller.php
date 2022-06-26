<?php

namespace App\Controllers;

/**
 * Contrôleur principal
 */
abstract class Controller
{
    public function render(string $fichier, array $donnees = [])
    {
        // Extrait le contenu de $donnees
        extract($donnees);

        // Chemin vers la vue
        require_once ROOT . '/Views/' . $fichier . '.php';
    }
}
