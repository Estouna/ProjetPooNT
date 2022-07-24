<?php

namespace App\Controllers;

use App\Models\CategoriesModel;

class CategoriesController extends Controller
{
    /* 
        -------------------------------------------------------- LISTE DES CATEGORIES --------------------------------------------------------
    */
    public function index()
    {
        // Instancie le modèle correspondant à la table annonces
        $categoriesModel = new CategoriesModel;

        // Sélection des annonces actives
        $categories = $categoriesModel->findBy(['parent_id' => 0]);

        // Sans compact(): $this->render('annonces/index', ['annonces' => $annonces]);
        $this->render('categories/index', compact('categories'));
    }

    /* 
        -------------------------------------------------------- LISTE DES SOUS-CATEGORIES --------------------------------------------------------
    */
    /* 
        -------------------------------------------------------- ANNONCES DE L'UTILSATEUR --------------------------------------------------------
    */
    public function sous_categories(int $id)
    {
        $categoriesModel = new CategoriesModel;

        $sub_categories = $categoriesModel->find($id);

        $this->render('categories/sous-categories', compact('sub-categories'));
    }
}
