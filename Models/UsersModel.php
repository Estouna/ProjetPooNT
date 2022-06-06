<?php

namespace App\Models;

class UsersModel extends Model
{
    protected $id;
    protected $email;
    protected $password;

    public function __construct()
    {
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

/*
    Création d'une nouvelle table users et d'une nouvelle classe UsersModel :

    Pour ajouter une table users (ou autres)
    1) On créer un fichier ici pour users on l'appelera UsersModel

    2) On commence par mettre le namespace, puis on crée la class UsersModel qu'on étend à Model
    - namespace App\Models;
    - class UsersModel extends Model

    3) On rentre les propriétés de la table en choisissant sa visibilité (ici protected)
    - protected $id;
    - protected $email;
    - protected $password;

    4) Dans le fichier index on instancie un nouvel user en mettant un use d'abord
    - use App\Models\UsersModel;
    - $model = new UsersModel;

    5) On crée le constructeur
    - public function __construct()
    - $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
    - $this->table = strtolower(str_replace('Model', '', $class));
    Ce qui permet d'avoir seulement users comme nom de table, on doit faire le str_replace en 2 fois parce que Model est après

    6) On créer les Getters/Setters des propriétés (protected $id, protected $email, et protected $password)

    7) Et c'est tout, maintenant on peut faire ce qu on a fait avec la table annonce avec cette nouvelle table

    Par exemple :
    - On instancie d'abord un nouvelle class UsersModel 
    $model = new UsersModel;

    $user = $model->setEmail('contact@nouvelle-techno.fr')
        ->setPassword(password_hash('azerty', PASSWORD_BCRYPT));

    $model->create($user);

    Et juste en faisant cela on crée un nouvel utilisateur 
    
    (je suis écoeuré, après ce que j'ai fais pour la certif)
*/