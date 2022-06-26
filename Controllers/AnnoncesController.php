<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        // Instancie le modèle correspondant à la table annonces
        $annoncesModel = new AnnoncesModel;

        // Sélection des annonces actives
        $annonces = $annoncesModel->findBy(['actif' => 1]);

        // Sans compact(): $this->render('annonces/index', ['annonces' => $annonces]);
        $this->render('annonces/index', compact('annonces'));
    }
}
