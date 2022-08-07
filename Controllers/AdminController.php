<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Models\CategoriesModel;
use App\Core\Form;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class AdminController extends Controller
{
    public function index()
    {
        // Vérifie si l'utilisateur est l'admin
        if ($this->isAdmin()) {
            $this->render('admin/index', [], 'admin');
        }
    }

    /* 
        -------------------------------------------------------- GESTION CATEGORIES --------------------------------------------------------
    */
    public function categories()
    {
        if ($this->isAdmin()) {

            $categoriesModel = new CategoriesModel;

            // Sélection des annonces actives
            $categoriesRacines = $categoriesModel->findBy(['parent_id' => 0]);

            // Sans compact(): $this->render('annonces/index', ['annonces' => $annonces]);
            $this->render('admin/categories', compact('categoriesRacines'), 'admin');
        }
    }

    public function ajoutCat()
    {
        if ($this->isAdmin()) {

            // Vérifie que les champs existent et ne sont pas vides (à compléter)
            if (Form::validate($_POST, ['titre', 'titre-sc'])) {

                $titre_cat = htmlspecialchars($_POST['titre']);
                $titre_sc = htmlspecialchars($_POST['titre-sc']);

                $categories = new CategoriesModel;

                $lft_cat = $categories->findLft_newCatRacine();
                $rght_cat = $categories->findRght_newCatRacineForOneSubCat();
                $parent_id_cat = 0;
                $level_cat = 0;

                // Hydrate la nouvelle catégorie
                $categories->setName($titre_cat)
                    ->setLft($lft_cat[0])
                    ->setRght($rght_cat[0])
                    ->setParent_id($parent_id_cat)
                    ->setLevel($level_cat);

                // Enregistre la catégorie dans la bdd
                $categories->create();


                $sous_categories = new CategoriesModel;

                $parent_id_sc = $sous_categories->findCategoryId_Max();
                $lft_sc = $sous_categories->findLft_newSubCat();
                $rght_sc = $sous_categories->findRght_newSubCat();
                $level_sc = 1;
            
                // Hydrate la nouvelle catégorie
                $sous_categories->setName($titre_sc)
                    ->setLft($lft_sc[0])
                    ->setrght($rght_sc[0])
                    ->setParent_id($parent_id_sc[0])
                    ->setLevel($level_sc);

                // // Enregistre la catégorie dans la bdd
                $sous_categories->create();

                // On redirige avec un message
                $_SESSION['success'] = "Votre catégorie a bien été créée";
                header('Location: /admin/categories');
                exit;
            } else {
                // Message de session
                $_SESSION['erreur'] = !empty($_POST) ? 'Vous devez donner un titre à la catégorie' : '';
            }
        }
        $this->render('admin/ajoutCat', [], 'admin');
    }

    public function ajoutSubCat()
    {
        if ($this->isAdmin()) {

        }
        $this->render('admin/ajoutSubCat', [], 'admin');
    }


    /* 
        -------------------------------------------------------- GESTION ANNONCES --------------------------------------------------------
    */
    /**
     * Affiche la liste des annonces
     * @return void
     */
    public function annonces()
    {
        if ($this->isAdmin()) {
            $annoncesModel = new AnnoncesModel;

            $annonces = $annoncesModel->findAll();

            $this->render('admin/annonces', compact('annonces'), 'admin');
        }
    }

    /**
     * Supprime une annonce
     * @param integer $id
     * @return void
     */
    public function supprimeAnnonce(int $id)
    {
        if ($this->isAdmin()) {
            $annonce = new AnnoncesModel;

            $annonce->delete($id);

            header('Location: /admin/annonces');
        }
    }

    /**
     * Active ou désactive une annonce
     *
     * @param integer $id
     * @return void
     */
    public function activeAnnonce(int $id)
    {
        if ($this->isAdmin()) {
            $annoncesModel = new AnnoncesModel;

            $annonceArray = $annoncesModel->find($id);

            if ($annonceArray) {
                $annonce = $annoncesModel->hydrate($annonceArray);

                $annonce->setActif($annonce->getActif() ? 0 : 1);
                // if($annonce->getActif()){
                //     $annonce->setActif(0);
                // }else{
                //     $annonce->setActif(1);
                // }

                $annonce->update();
            }
        }
    }

    /**
     * Méthode qui vérifie si on est administrateur
     * @return boolean
     */
    private function isAdmin()
    {
        // Vérifie si l'utilisateur est connecté et que son rôle est "ROLE_ADMIN"
        if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
            // Si admin
            return true;
        } else {
            // Si pas admin
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette zone";
            header('Location: /users/login');
            exit;
        }
    }
}
