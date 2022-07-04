<?php

namespace App\Models;

use App\Core\Db;

/**
 * Modèle principal
 */
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

        // Boucle pour éclater le tableau $criteres en deux tableaux
        foreach ($criteres as $champ => $valeur) {

            // On push dans les tableaux $champs et $valeurs ($valeur pour le ? de "$champ = ?")
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // Transforme le tableau $champs et ses champs séparées en une chaîne de caractères qui rassemble les champs sur une seule ligne.
        $liste_champs = implode(' AND ', $champs);

        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    // Récupère un élément par son id
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    /* 
       ////////////////////////////////////////  REQUETE  //////////////////////////////////////// 
    */
    // Execute ou prépare une requête selon les cas
    public function requete(string $sql, array $attributs = null)
    {
        // Récupère l'instance de Db
        $this->db = Db::getInstance();

        // Vérifie si on a des attributs
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
        ////////////////////////////////////////  CREATE  //////////////////////////////////////// 
    */
    public function create()
    {
        $champs = [];
        $interro = [];
        $valeurs = [];

        // Boucle pour éclater le tableau
        foreach ($this as $champ => $valeur) {
            // ex : INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $interro[] = "?";
                $valeurs[] = $valeur;
            }
        }

        // Transforme les tableaux en chaîne de caractères
        $liste_champs = implode(', ', $champs);
        $liste_interro = implode(', ', $interro);

        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ')VALUES(' . $liste_interro . ')', $valeurs);
    }

    /* 
        ////////////////////////////////////////  UPDATE  //////////////////////////////////////// 
    */
    public function update()
    {
        $champs = [];
        $valeurs = [];

        // Boucle pour éclater le tableau
        foreach ($this as $champ => $valeur) {
            // ex : UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id= ?
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;

        // Transforme le tableau champs en une chaîne de caractères
        $liste_champs = implode(', ', $champs);

        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }

    /* 
        ////////////////////////////////////////  DELETE  //////////////////////////////////////// 
    */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /* 
        ////////////////////////////////////////  HYDRATER  //////////////////////////////////////// 
    */
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value) {
            // Récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // Appelle le setter.
                $this->$method($value);
            }
        }
        return $this;
    }
}
