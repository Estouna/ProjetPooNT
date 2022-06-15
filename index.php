<?php


use App\Autoloader;
use App\Models\AnnoncesModel;
use App\Models\UsersModel;

require_once 'Autoloader.php';

Autoloader::register();

// ________________________________________________________________________________________________________________________________________


// $model = new AnnoncesModel;
$model = new UsersModel;

$user = $model->setEmail('contact@nouvelle-techno.fr')
        ->setPassword(password_hash('azerty', PASSWORD_BCRYPT));

    $model->create($user);



// $annonces = $model->find(2);

// $donnees = [
//     'titre' => 'Annonce modifiée',
//     'description' => 'Description de l\'annonce modifiée',
//     'actif' => 0
// ];

// $annonce = $model->hydrate($donnees);

// $model->delete(4);

// var_dump($annonce);
// var_dump($model);
