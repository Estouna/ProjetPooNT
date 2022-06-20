<?php

use App\Autoloader;

// Défini une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

// Import de l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

echo "Bonjour";