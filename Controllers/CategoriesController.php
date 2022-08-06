<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\AnnoncesModel;

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
    /**
     * Affiche les sous-catégories
     *
     * @param integer $parent_id
     * @return void
     */
    public function sous_categories(int $parent_id)
    {
        $categoriesModel = new CategoriesModel;

        $sub_categories = $categoriesModel->findSubCategoriesByParent_id($parent_id);

        $this->render('categories/sous_categories', compact('sub_categories'));
    }

    /* 
        -------------------------------------------------------- ANNONCES DE L'UTILSATEUR --------------------------------------------------------
    */

    public function annonces(int $id_category)
    { 
        $annoncesModel = new AnnoncesModel;
        
        $annonces = $annoncesModel->findAllByCategoryId($id_category);
        
        $this->render('categories/annonces', compact('annonces'));
    }
}
