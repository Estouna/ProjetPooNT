<?php

namespace App\Models;

use RecursiveIteratorIterator;
use RecursiveArrayIterator;

class CategoriesModel extends Model
{
    protected $id;
    protected $name;
    protected $lft;
    protected $rght;
    protected $parent_id;
    protected $level;


    /* 
        -------------------------------------------------------- CONSTRUCTEUR --------------------------------------------------------
    */


    public function __construct()
    {
        $this->table = 'categories_interval';
    }

    /* 
       ----------  TROUVER L'ID DE LA CATEGORIE PARENTE ----------
    */
    public function findId_cat(int $id)
    {
        $id_cat = $this->requete("SELECT id FROM {$this->table} WHERE id = $id")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($id_cat));
        $parent_id = iterator_to_array($it, false);
        return $parent_id;
    }

    /* 
       ----------  TROUVER LES SOUS-CATEGORIES D'UNE CATEGORIE ----------
    */
    public function findSubCategoriesByParent_id($parent_id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE parent_id = $parent_id")->fetchAll();
    }


    /* 
        -------------------------------------------------------- AJOUT D'UNE NOUVELLE CATEGORIE RACINE ET DE SA SOUS-CATEGORIE --------------------------------------------------------
    */


    /* 
        ---------- BORD DROIT DE LA NOUVELLE CATEGORIE RACINE ----------
    */
    public function findLft_newCatRacine()
    {
        $rght_desc = $this->requete("SELECT MAX(rght + 1) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($rght_desc));
        $lft_cat = iterator_to_array($it, false);
        return $lft_cat;
    }

    /* 
    ---------- BORD GAUCHE DE LA NOUVELLE CATEGORIE RACINE ----------
    */
    public function findRght_newCatRacineForOneSubCat()
    {
        $rght_desc = $this->requete("SELECT MAX(rght + 4) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($rght_desc));
        $rght_cat = iterator_to_array($it, false);
        return $rght_cat;
    }

    /* 
       ----------  TROUVER L'ID LE PLUS HAUT DE LA TABLE DES CATEGORIES ----------
    */
    public function findCategoryId_Max()
    {
        $id_max = $this->requete("SELECT id FROM {$this->table} ORDER BY id DESC")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($id_max));
        $parent_id = iterator_to_array($it, false);
        return $parent_id;
    }

    /* 
       ---------- BORD GAUCHE DE LA SOUS-CATEGORIE DE LA NOUVELLE CATEGORIE RACINE ----------
    */
    public function findLft_newSubCatRac()
    {
        $lft_catRacine = $this->requete("SELECT MAX(lft + 1) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($lft_catRacine));
        $lft_sc = iterator_to_array($it, false);
        return $lft_sc;
    }

    /* 
       ---------- BORD DROIT DE LA SOUS-CATEGORIE DE LA NOUVELLE CATEGORIE RACINE ----------
    */
    public function findRght_newSubCatRac()
    {
        $lft_catRacine = $this->requete("SELECT MAX(lft + 2) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($lft_catRacine));
        $rght_sc = iterator_to_array($it, false);
        return $rght_sc;
    }


    /* 
        -------------------------------------------------------- AJOUT D'UNE NOUVELLE SOUS-CATEGORIE --------------------------------------------------------
    */


    /* 
       ----------  MET A JOUR LES BORDS POUR INSERER LA NOUVELLE SOUS CATEGORIE (en sélectionnant le bord droit le plus haut des enfants de la catégorie racine) ----------
    */
    public function update_rghtLft($parent_id)
    {
        $child_rght_max = $this->requete("SELECT MAX(rght) FROM {$this->table} WHERE parent_id = $parent_id")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($child_rght_max));
        $rghtChildMax = iterator_to_array($it, false);

        $this->requete("UPDATE {$this->table} SET rght = rght + 2 WHERE rght > $rghtChildMax[0]");

        $this->requete("UPDATE {$this->table} SET lft = lft + 2 WHERE lft > $rghtChildMax[0]");
    }

    /* 
       ---------- BORD GAUCHE DE LA SOUS-CATEGORIE DE LA NOUVELLE CATEGORIE RACINE ----------
    */
    public function findLft_newSubCat($parent_id)
    {
        $lft_catParent = $this->requete("SELECT MAX(rght + 1) FROM {$this->table} WHERE parent_id = $parent_id")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($lft_catParent));
        $lft_sc = iterator_to_array($it, false);
        return $lft_sc;
    }

    /* 
       ---------- BORD DROIT DE LA SOUS-CATEGORIE DE LA NOUVELLE CATEGORIE RACINE ----------
    */
    public function findRght_newSubCat($parent_id)
    {
        $lft_catParent = $this->requete("SELECT MAX(rght + 2) FROM {$this->table} WHERE parent_id = $parent_id")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($lft_catParent));
        $rght_sc = iterator_to_array($it, false);
        return $rght_sc;
    }

    /* 
       ----------  TROUVER LE LEVEL DE LA SOUS-CATEGORIE ----------
    */
    public function findLevel_cat(int $id)
    {
        $level = $this->requete("SELECT level + 1 FROM {$this->table} WHERE id = $id")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($level));
        $level_sc = iterator_to_array($it, false);
        return $level_sc;
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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lft
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set the value of lft
     *
     * @return  self
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get the value of rght
     */
    public function getRght()
    {
        return $this->rght;
    }

    /**
     * Set the value of rght
     *
     * @return  self
     */
    public function setRght($rght)
    {
        $this->rght = $rght;

        return $this;
    }

    /**
     * Get the value of parent_id
     */
    public function getParent_id()
    {
        return $this->parent_id;
    }
    /**
     * Set the value of parent_id
     *
     * @return  self
     */
    public function setParent_id($parent_id)
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * Get the value of level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     *
     * @return  self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }
}
