<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Models\CategoriesModel;
use App\Core\Form;

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

    /* 
        ------------- AJOUT D'UNE NOUVELLE CATEGORIE RACINE ET SA SOUS-CATEGORIE -------------
    */
    public function ajoutCat()
    {
        if ($this->isAdmin()) {

            // Vérifie que les champs existent et ne sont pas vides (à compléter)
            if (Form::validate($_POST, ['titre', 'titre-scRac'])) {

                $titre_cat = htmlspecialchars($_POST['titre']);
                $titre_sc_rac = htmlspecialchars($_POST['titre-scRac']);

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
                $lft_sc = $sous_categories->findLft_newSubCatRac();
                $rght_sc = $sous_categories->findRght_newSubCatRac();
                $level_sc = 1;

                // Hydrate la nouvelle catégorie
                $sous_categories->setName($titre_sc_rac)
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

    /* 
        ------------- AJOUT D'UNE NOUVELLE SOUS-CATEGORIE -------------
    */
    public function ajoutSubCat(int $id)
    {
        if ($this->isAdmin()) {

            $categoriesModel = new CategoriesModel;
            $sub_categories = $categoriesModel->findSubCategoriesByParent_id($id);
            $categories = $categoriesModel->find($id);
            // var_dump($categories);

            if (Form::validate($_POST, ['titre-sc'])) {


                $titre_sc = htmlspecialchars($_POST['titre-sc']);

                $sous_categories = new CategoriesModel;

                if ($categories->rght - $categories->lft >= 3) {
                    // Augmente les bords droit et gauche de + 2 à partir du bord droit le plus haut des enfants de la catégorie racine (insertion de la sous-catégorie sur la droite)
                    $update_rghtLft = $categoriesModel->update_rghtLft($id);

                    $lft = $sous_categories->findLft_newSubCat($id);
                    $rght = $sous_categories->findRght_newSubCat($id);
                }

                if ($categories->rght - $categories->lft < 3) {

                    $annonces = new AnnoncesModel;
                    $annoncesExist = $annonces->findAllByCategoryId($id);
                    if (empty($annoncesExist)) {
                        // Augmente les bords droit et gauche de + 2 à partir du bord droit de la catégorie parente
                        $update_forLeafTree = $categoriesModel->updateRghtLft_forLeafTree($id);
                    } else {
                        $_SESSION['erreur'] = 'Vous devez déplacer les articles de cette catégorie avant de pouvoir ajouter une sous-catégorie';
                    }

                    $lft = $sous_categories->findLft_newSubCat_leafTree($id);
                    $rght = $sous_categories->findRght_newSubCat_leafTree($id);
                }


                $parent_id = $sous_categories->findId_cat($id);
                $level = $sous_categories->findLevel_cat($id);

                // Hydrate la nouvelle sous-catégorie
                $sous_categories->setName($titre_sc)
                    ->setLft($lft[0])
                    ->setrght($rght[0])
                    ->setParent_id($parent_id[0])
                    ->setLevel($level[0]);

                // Enregistre la catégorie dans la bdd
                $sous_categories->create();

                // On redirige avec un message
                $_SESSION['success'] = "Votre sous-catégorie a bien été créée";
                header('Location: /admin/categories');
                exit;
            } else {
                // Message de session
                $_SESSION['erreur'] = !empty($_POST) ? 'Vous devez donner un titre à la sous-catégorie' : '';
            }
        }

        $this->render('admin/ajoutSubCat', compact('sub_categories', 'categories'), 'admin');
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
