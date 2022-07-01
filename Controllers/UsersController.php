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
            ->finForm();

        var_dump($form);
    }
}
