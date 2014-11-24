<?php
// Site
define("SITENAME","Discuss v2.0");

// securité mdp
define("SALT","ServiceDeDiscussionParPurexo"); // veuillez changer ce sel pour plus de sécurité (le poivre seras le login de l'user)
define("ALGO","sha512"); // Algo de hashage. whirpool peu connu mais aussi secure que du SHA512 donc Rainbow-table quasi inexistante

// bdd
define("DB_HOST","127.0.0.1");
define("DB_USER","purexo");
define("DB_PASS","");//""
define("BASE","c9");
define("PORT","3306");//3306

define('DEBUG',0);
define('CLASSES',dirname($_SERVER["SCRIPT_FILENAME"])."/tables");
?>