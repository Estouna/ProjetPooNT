<?php

namespace App\Models;

class CategoriesModel extends Model
{
    protected $id;
    protected $name;
    protected $lft;
    protected $rght;
    protected $parent_id;


    /* 
        -------------------------------------------------------- CONSTRUCTEUR --------------------------------------------------------
    */
    public function __construct()
    {
        $this->table = 'categories_interval';
    }

    /* 
       ----------  TROUVER LES SOUS-CATEGORIES D'UNE CATEGORIE PAR SON PARENT_ID ----------
    */
    public function findSubCategoriesByParent_id($parent_id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE parent_id = $parent_id")->fetchAll();
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
}
