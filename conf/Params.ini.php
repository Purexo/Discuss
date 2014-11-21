<?php
// Site
define("SITENAME","Discuss v2.0");

// securité mdp
define("SALT","ServiceDeDiscussionParPurexo"); // veuillez changer ce sel pour plus de sécurité (le poivre seras le login de l'user)
define("ALGO","sha512"); // Algo de hashage. whirpool peu connu mais aussi secure que du SHA512 donc Rainbow-table quasi inexistante

// bdd
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");//""
define("BASE","discuss2");
define("PORT","3306");//3306

define('DEBUG',0);
define('CLASSES',dirname($_SERVER["SCRIPT_FILENAME"])."/tables");
?>