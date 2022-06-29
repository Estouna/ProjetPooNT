<?php

namespace App\Core;

class Form
{
    private $formCode = "";

    /**
     * Génère le formulaire HTML
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    // XXXX Validation simple à améliorer XXXX
    /**
     * Vérifie et valide si tous les champs sont remplis
     * @param array $form Tableau contenant les champs à vérifier
     * @param array $fields Tableau listant les champs à vérifier
     * @return bool
     */
    public static function validate(array $form, array $fields)
    {
        // Parcourt les champs
        foreach ($fields as $field) {

            // Vérifie si le champ est absent ou vide dans le formulaire
            if (!isset($form[$field]) || empty($form[$field])) {
                // Sort dès le premier champ faux en retournant false
                return false;
            }
        }
        // Sinon valide en retournant true
        return true;
    }
}
