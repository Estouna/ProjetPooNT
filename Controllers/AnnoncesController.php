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

    /**
     * Affiche une annonce
     * @param integer $id
     * @return void
     */
    public function lire(int $id)
    {
        // Instancie le modèle
        $annoncesModel = new AnnoncesModel;

        // Récupère une annonce par son id
        $annonce = $annoncesModel->find($id);

        // Envoi à la vue
        $this->render('annonces/lire', compact('annonce'));
    }
}
