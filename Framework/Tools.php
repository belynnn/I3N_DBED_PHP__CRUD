<?php

require_once 'View.php';

class Tools
{
    public static function sanitize($var) // permet de nettoyer les requêtes get et post de tout caractères spéciaux pour éviter l'injection sql
    {
        $var = stripcslashes($var); // \a, \b, \f, \n, \r, \t and \v
        $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTM
        $var = strip_tags($var); // Supprime les balises HTML et PHP d'une chaîne

        return $var;
    }
    public static function abort($err) //affichage des erreurs
    {
        $view = new View("error");
        $view->show(["error" => $err]);
        die;
    }
}
