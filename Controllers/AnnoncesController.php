<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Core\Form;

class AnnoncesController extends Controller
{
    /* 
        -------------------------------------------------------- LISTE LES ANNONCES ACTIVES --------------------------------------------------------
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


    /* 
        -------------------------------------------------------- PUBLIER UNE ANNONCE --------------------------------------------------------
    */
    /**
     * Ajouter une annonce
     * @return void
     */
    public function ajouter()
    {
        // Vérifie si la session contient les informations d'un utilisateur
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

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
                $_SESSION['success'] = "Votre annonce a été enregistrée";
                header('Location: /');
                exit;
            } else {
                // Message de session
                $_SESSION['erreur'] = !empty($_POST) ? 'Vous devez remplir tous les champs' : '';

                // Laisse le texte entré
                $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
                $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
            }


            $form = new Form;

            // Formulaire
            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
                ->ajoutInput('text', 'titre', [
                    'class' => 'form-control',
                    'value' => $titre
                ])
                ->ajoutLabelFor('description', 'Texte de l\'annonce :')
                ->ajoutTextarea('description', $description, ['class' => 'form-control'])
                ->ajoutBouton('Publier', ['type' => 'submit', 'name' => 'validatePubli', 'class' => 'btn btn-primary my-4'])
                ->finForm();

            // Envoi à la vue  
            $this->render('annonces/ajouter', ['ajoutForm' => $form->create()]);
        } else {
            header('Location: /users/login');
            exit;
        }
    }


    /* 
        -------------------------------------------------------- MODIFIER UNE ANNONCE --------------------------------------------------------
    */
    public function modifier(int $id)
    {
        // Vérifie qu'un utilisateur existe et que son id ne soit pas vide
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

            // Instancie le modèle des annonces
            $annonceModel = new AnnoncesModel;

            // Cherche l'annonce par son id
            $annonce = $annonceModel->find($id);

            // Si l'annonce n'existe pas
            if (!$annonce) {
                http_response_code(404);
                $_SESSION['erreur'] = "L'annonce recherchée n'existe pas";
                header('Location: /');
                exit;
            }

            // Si l'id de l'utilisateur de l'annonce ne correspond pas à l'id de session de l'utilisateur 
            if ($annonce->users_id !== $_SESSION['user']['id']) {
                // Si dans le tableau de la session de l'utilisateur, le rôle 'ROLE_ADMIN' n'existe pas
                if (!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
                    // Redirige vers l'accueil
                    http_response_code(404);
                    $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
                    header('Location: /');
                    exit;
                }
            }

            // Vérifie que les champs existent et ne sont pas vides (à compléter)
            if (Form::validate($_POST, ['titre', 'description'])) {
                // Sécurise les données
                $titre = strip_tags($_POST['titre']);
                $description = strip_tags($_POST['description']);

                // Instancie le modèle des annonces
                $annonceModif = new AnnoncesModel;

                // Hydrate (sans users_id pour ne pas transférer id si modérateur ou admin modifie)
                $annonceModif->setId($annonce->id)
                    ->setTitre($titre)
                    ->setDescription($description);

                // Mise à jour de l'annonce dans la bdd
                $annonceModif->update();

                // Si admin redirige vers liste des annonces admin
                if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
                    header('Location: /admin/annonces');
                    exit;
                }
                // Si utilisateur redirige vers
                $_SESSION['success'] = "L'annonce a bien été modifiée";
                header('Location: /');
                exit;
            } else {
                // Message de session et rechargement de la page
                $_SESSION['erreur'] = !empty($_POST) ? 'Vous devez remplir tous les champs' : '';
            }


            $form = new Form;

            // Formulaire
            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
                ->ajoutInput('text', 'titre', ['class' => 'form-control', 'value' => $annonce->titre])
                ->ajoutLabelFor('description', 'Description')
                ->ajoutTextarea('description', $annonce->description, ['class' => 'form-control'])
                ->ajoutBouton('Modifier', ['type' => 'submit', 'name' => 'validateModif', 'class' => 'btn btn-primary']);

            // Envoi à la vue
            $this->render('annonces/modifier', ['modifForm' => $form->create()]);
        } else {
            header('Location: /users/login');
            exit;
        }
    }
}
