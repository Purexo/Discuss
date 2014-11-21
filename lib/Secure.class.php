<?php
    class Secure {
        /*
        * Prend en entré un tableau de chaine de caractere à sécuriser
        * retourne un tableau clean de toutes failles XSS
        */
        public static function htmlentitiesOnArray($tab=array()) {
            $res = array();
            foreach ($tab as $key => $value) $res["$key"] = htmlentities($value);

            return $res;
        }
    }
?>