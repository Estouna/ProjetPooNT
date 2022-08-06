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
       ----------  TROUVER LES SOUS-CATEGORIES D'UNE CATEGORIE ----------
    */
    public function findSubCategoriesByParent_id($parent_id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE parent_id = $parent_id")->fetchAll();
    }

    /* 
       ----------  TROUVER L'ID LE PLUS HAUT ----------
    */
    public function findCategoryId_Max()
    {
        $id_max = $this->requete("SELECT id FROM {$this->table} ORDER BY id DESC")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($id_max));
        $parent_id = iterator_to_array($it, false);
        return $parent_id;
    }

    /* 
       ----------  TROUVER LE BORD DROIT MAX + 1 DAND LA BDD----------
    */
    public function findLft_newCatRacine()
    {
        $rght_desc = $this->requete("SELECT MAX(rght + 1) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($rght_desc));
        $lft_cat = iterator_to_array($it, false);
        return $lft_cat;
    }

    public function findRght_newCatRacineForOneSubCat()
    {
        $rght_desc = $this->requete("SELECT MAX(rght + 4) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($rght_desc));
        $rght_cat = iterator_to_array($it, false);
        return $rght_cat;
    }

    public function findLft_newSubCat()
    {
        $lft_catRacine = $this->requete("SELECT MAX(lft + 1) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($lft_catRacine));
        $lft_sc = iterator_to_array($it, false);
        return $lft_sc;
    }

    public function findRght_newSubCat()
    {
        $lft_catRacine = $this->requete("SELECT MAX(lft + 2) FROM {$this->table}")->fetch();
        $it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($lft_catRacine));
        $rght_sc = iterator_to_array($it, false);
        return $rght_sc;
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
