<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Core\Form;

class AnnoncesController extends Controller
{
    /* 
        -------------------------------------------------------- LISTE ANNONCES ACTIVES --------------------------------------------------------
    */
    public function index()
    {
        // Instancie le modèle correspondant à la table annonces
        $annoncesModel = new AnnoncesModel;

        // Sélection des annonces actives
        $annonces = $annoncesModel->findBy(['actif' => 1]);

        // Sans compact(): $this->render('annonces/index', ['annonces' => $annonces]);
        $this->render('annonces/index', compact('annonces'));
    }

    /* 
        -------------------------------------------------------- LIRE UNE ANNONCE --------------------------------------------------------
    */
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

    /**
     * Ajouter une annonce
     * @return void
     */
    public function ajouter()
    {
        // Vérifie si la session contient les informations d'un utilisateur
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

            if (isset($_POST['validatePubli'])) {
                // Vérifie que les champs existent et ne sont pas vides (à compléter)
                if (Form::validate($_POST, ['titre', 'description'])) {
                    // Sécurise les données
                    $titre = strip_tags($_POST['titre']);
                    $description = strip_tags($_POST['description']);

                    // Instancie le modèle des annonces
                    $annonce = new AnnoncesModel;

                    // Hydrate l'annonce
                    $annonce->setTitre($titre)
                        ->setDescription($description)
                        ->setUsers_id($_SESSION['user']['id']);

                    // Enregistre l'annonce dans la bdd
                    $annonce->create();

                    // On redirige avec un message
                    $_SESSION['success'] = "Votre annonce a bien été enregistrée";
                    header('Location: /');
                    exit;
                } else {
                    // Message de session et rechargement de la page
                    $_SESSION['erreur'] = 'Les champs doivent être remplis avant de publier';
                    header('Location: /annonces/ajouter');
                    exit;
                }
            }

            $form = new Form;

            // Formulaire
            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
                ->ajoutInput('text', 'titre', ['class' => 'form-control'])
                ->ajoutLabelFor('description', 'Texte de l\'annonce :')
                ->ajoutTextarea('description', '', ['class' => 'form-control'])
                ->ajoutBouton('Publier', ['type' => 'submit', 'name' => 'validatePubli', 'class' => 'btn btn-primary my-4'])
                ->finForm();

            // Envoi à la vue  
            $this->render('annonces/ajouter', ['form' => $form->create()]);
        } else {
            header('Location: /users/login');
            exit;
        }
    }
}
