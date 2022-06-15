<?php

namespace App\Models;

use App\Db\Db;

class Model extends Db
{
    // Table de la base de données
    protected $table;
    // Instance de Db
    private $db;

    /* 
        -------------------------------------------------------- METHODES --------------------------------------------------------
    */



    /* 
       ////////////////////////////////////////  READ  //////////////////////////////////////// 
    */
    // Récupère toutes les données d'une table
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    // Récupère les données d'une table par critères (par ex : "$annonces = $model->findBy([‘actif’ => 1]) ;")
    public function findBy(array $criteres)
    {
        // Tableaux vides pour les champs et les valeurs
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau $criteres en deux tableaux
        foreach ($criteres as $champ => $valeur) {

            // On push dans les tableaux $champs et $valeurs ($valeur pour le ? de "$champ = ?")
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // Transforme le tableau $champs et ses champs séparées en une chaîne de caractères qui rassemble les champs sur une seule ligne.
        $liste_champs = implode(' AND ', $champs);

        // On exécute la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    // Récupère un élément par son id
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }
    /* 
        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    */



    /* 
       ////////////////////////////////////////  REQUETE  //////////////////////////////////////// 
    */
    // Execute ou prépare une requête selon les cas
    public function requete(string $sql, array $attributs = null)
    {
        // On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attributs
        if ($attributs !== null) {
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->query($sql);
        }
    }
    /* 
        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    */



    /* 
        ////////////////////////////////////////  CREATE  //////////////////////////////////////// 
    */
    // Créer une annonce
    public function create(Model $model)
    {
        $champs = [];
        $interro = [];
        $valeurs = [];

        foreach ($model as $champ => $valeur) {
            if ($valeur != null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $interro[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(', ', $champs);
        $liste_interro = implode(', ', $interro);

        // On execute la requête
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ')VALUES(' . $liste_interro . ')', $valeurs);
    }
    /* 
        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    */



    /* 
        ////////////////////////////////////////  UPDATE  //////////////////////////////////////// 
    */
    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];

        foreach ($model as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        $liste_champs = implode(', ', $champs);

        // On execute la requête
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }
    /* 
        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    */



    /* 
        ////////////////////////////////////////  DELETE  //////////////////////////////////////// 
    */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }
    /* 
        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    */



    /* 
        ////////////////////////////////////////  HYDRATER  //////////////////////////////////////// 
    */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
        return $this;
    }
    /* 
        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    */
}
