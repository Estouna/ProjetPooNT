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
        $form = new Form;

        // On peut changer les valeurs par défaut (method et action) et mettre d'autres attributs dans un tableau. 
        // Exemple: $form->debutForm('get', 'login.php', ['class' => 'form', 'id' => 'loginForm'])
        $form->debutDiv(['class' => 'd-flex justify-content-center align-items-center'])
            ->debutForm('post', '#', ['class' => 'w-75'])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->debutDiv(['class' => 'text-center mt-3'])
            ->ajoutBouton('Me connecter', ['class' => 'btn btn-primary my-4'])
            ->finDiv()
            ->finForm()
            ->finDiv();

        // Envoi le formulaire à la vue
        $this->render('users/login', ['loginForm' => $form->create()]);
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
        // Vérifie le formulaire (juste si les champs existent et qu'ils ne sont pas vides, à compléter plus tard)
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
        }

        $form = new Form;

        $form->debutDiv(['class' => 'd-flex justify-content-center align-items-center'])
            ->debutForm('post', '#', ['class' => 'w-75'])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('pass', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'pass'])
            ->debutDiv(['class' => 'text-center mt-3'])
            ->ajoutBouton('M\'inscrire', ['class' => 'btn btn-primary my-4'])
            ->finDiv()
            ->finForm()
            ->finDiv();

        // Envoi le formulaire à la vue
        $this->render('users/register', ['registerForm' => $form->create()]);
    }
}
