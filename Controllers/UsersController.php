<?php

namespace App\Controllers;

use App\Core\Form;


class UsersController extends Controller
{
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
}
