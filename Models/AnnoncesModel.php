<?php

namespace App\Models;

class AnnoncesModel extends Model
{
    protected $id;
    protected $titre;
    protected $description;
    protected $created_at;
    protected $actif;


    /* 
        -------------------------------------------------------- CONSTRUCTEUR --------------------------------------------------------
    */
    public function __construct()
    {
        $this->table = 'annonces';
    }


    /* 
        -------------------------------------------------------- GETTERS/SETTERS --------------------------------------------------------
    */
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

    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of actif
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set the value of actif
     *
     * @return  self
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }
}


/*
    On crée d'abord le constructeur de la classe qui sera très simple
        $this->table = 'annonces';
        - On récupère table qu'on relie à annonces et c'est tout.
        Maintenant qu'on a fait ça, on peut interroger la base de données et récupérer toute les annonces de cette façon :
        En ajoutant dans le fichier index.php un use App\Models\AnnoncesModel; et en instanciant $model = new AnnoncesModel;

    On ajoute les différents champs de la table annonces ($id, $titre, etc) et on crée leurs getters/setters 
    (Rappel Getters/Setters parce qu'on est en protected (private pareil) et qu'on ne pas y accèder directement)

    Les return $this dans les setters vont nous servir à créer les différentes informations directement en une fois depuis notre instance de Model.
    Exemple:

    - Si on veut créer ces différentes informations, on instancie de cette façon
    $annonce = $model
        ->setTitre('Nouvelle annonce')
        ->setDescription('Nouvelle description')
        ->setActif(0)
        ->etc;
    On peut enchaîner de cette manière parce que chaque Setters retourne l'objet (return $this), 
    ce qui veut dire qu'on retourne l'objet systématiquemnt et qu'on va pouvoir l'utiliser de cette façon

    - Si on veut créer une annonce il faudrait pourvoir faire
    $model->create($annonce)
    On va donc créer une méthode dans notre Model(Model.php)

*/