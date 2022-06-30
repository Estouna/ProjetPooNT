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

    /**
     * Ajoute les attributs envoyés à la balise
     * @param array $attributs Tableau associatif ['class' => 'form-control', 'required' => true]
     * @return string Chaine de caractères générée
     */
    private function ajoutAttributs(array $attributs): string
    {
        // Initialise une chaîne de caractères
        $str = '';

        // Liste les attributs "courts" (qui n'ont pas de valeurs)
        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // Parcourt le tableau d'attributs
        foreach ($attributs as $attribut => $valeur) {
            // Si l'attribut est dans le tableau $courts (in_array())
            if (in_array($attribut, $courts) && $valeur == true) {
                $str .= " $attribut";
            } else {
                // Ajoute attribut='valeur'
                $str .= " $attribut='$valeur'";
            }
        }

        return $str;
    }
}
