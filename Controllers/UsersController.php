<?php

namespace App\Controllers;

use App\Core\Form;


class UsersController extends Controller
{
    /**
     * Connexion des utilisateurs
     * @return void
     */
    public function login()
    {
        $form = new Form;

        // On peut changer les valeurs par défaut (method et action) et mettre d'autres attributs dans un tableau. 
        // Exemple: $form->debutForm('get', 'login.php', ['class' => 'form', 'id' => 'loginForm'])
        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->ajoutBouton('Me connecter', ['class' => 'btn btn-primary my-4'])
            ->finForm();

        // Envoi le formulaire à la vue
        $this->render('users/login', ['loginForm' => $form->create()]);
    }

    /**
     * Inscription des utilisateurs
     * @return void
     */
    public function register()
    {
        var_dump($_POST);
        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->ajoutLabelFor('pass', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'pass'])
            ->ajoutBouton('M\'inscrire', ['class' => 'btn btn-primary my-4'])
            ->finForm();

        // Envoi le formulaire à la vue
        $this->render('users/register', ['registerForm' => $form->create()]);
    }
}
