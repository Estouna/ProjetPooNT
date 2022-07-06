<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;


class UsersController extends Controller
{
    /* 
        -------------------------------------------------------- CONNEXION --------------------------------------------------------
    */

    /**
     * Connexion des utilisateurs
     * @return void
     */
    public function login()
    {
        if (isset($_POST['validateLog'])) {
            // Vérifie le formulaire (juste si les champs existent et qu'ils ne sont pas vides, à compléter plus tard)

            if (Form::validate($_POST, ['email', 'password'])) {
                // Récupère l'utilisateur par son email
                $userModel = new UsersModel;
                $userArray = $userModel->findOneByEmail(strip_tags($_POST['email']));

                // Si l'utilisateur n'existe pas
                if (!$userArray) {
                    // http_response_code(404);
                    $_SESSION['erreur'] = 'L\'adresse email et/ou le mot de passe est incorrect';
                    header('Location: /users/login');
                    exit;
                }

                // S'il existe hydrate l'objet
                $user = $userModel->hydrate($userArray);

                // Vérifie le mot de passe
                if (password_verify($_POST['password'], $user->getPassword())) {
                    // Si bon mot de passe, création la session
                    $user->setSession();

                    // Redirige vers l'accueil
                    header('Location: /');
                    exit;
                } else {
                    // Si mauvais mot de passe
                    $_SESSION['erreur'] = 'L\'adresse email et/ou le mot de passe est incorrect';
                    header('Location: /users/login');
                    exit;
                }
            } else {
                // Message de session et rechargement de la page
                $_SESSION['erreur'] = 'Tous les champs doivent être remplis';
                header('Location: /users/login');
                exit;
            }
        }

        $form = new Form;

        // On peut changer les valeurs par défaut (method et action) et mettre d'autres attributs dans un tableau. 
        // Exemple: $form->debutForm('get', 'login.php', ['class' => 'form', 'id' => 'loginForm'])
        $form->debutForm('post', '#', ['class' => 'w-75'])
            ->ajoutLabelFor('email', 'E-mail :', ['class' => 'text-primary'])
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('password', 'Mot de passe :', ['class' => 'text-primary'])
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->debutDiv(['class' => 'text-center mt-3'])
            ->ajoutBouton('Me connecter', ['type' => 'submit', 'name' => 'validateLog', 'class' => 'btn btn-primary my-4'])
            ->finDiv()
            ->finForm();

        // Envoi le formulaire à la vue
        $this->render('users/login', ['loginForm' => $form->create()], 'login-register');
    }

    /* 
        -------------------------------------------------------- INSCRIPTION --------------------------------------------------------
    */

    /**
     * Inscription des utilisateurs
     * @return void
     */
    public function register()
    {
        if (isset($_POST['validateReg'])) {
            
            // Vérifie si le formulaire est valide
            if (Form::validate($_POST, ['email', 'password'])) {
                // Nettoie l'adresse mail
                $email = strip_tags($_POST['email']);

                // Hash le mot de passe (ARGON2I à partir de PHP 7.2)
                $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);

                // Hydrate l'utilisateur
                $user = new UsersModel;
                $user->setEmail($email)
                    ->setPassword($pass);

                // Enregistre l'utilisateur dans la bdd
                $user->create();

                // Redirige vers l'accueil
                header('Location: /');
                exit;
            } else {
                $_SESSION['erreur'] = 'Tous les champs doivent être remplis';
                header('Location: /users/register');
                exit;
            }
        }

        $form = new Form;

        $form->debutForm('post', '#', ['class' => 'w-75'])
            ->ajoutLabelFor('email', 'E-mail :', ['class' => 'text-primary'])
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('pass', 'Mot de passe :', ['class' => 'text-primary'])
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'pass'])
            ->debutDiv(['class' => 'text-center mt-3'])
            ->ajoutBouton('M\'inscrire', ['type' => 'submit', 'name' => 'validateReg', 'class' => 'btn btn-primary my-4'])
            ->finDiv()
            ->finForm();

        // Envoi le formulaire à la vue
        $this->render('users/register', ['registerForm' => $form->create()], 'login-register');
    }

    /* 
        -------------------------------------------------------- DECONNEXION --------------------------------------------------------
    */

    /**
     * Déconnexion des utilisateurs
     * @return exit
     */
    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
