# Discuss
Discuss a pour objectif d'être un service simple à appréhender et à mettre en place. Il se situe à mi-chemin entre un Forum et un "posteur de commentaire".

Pour faire simple, après inscription il sera possible de créer des discussions(/topics) en les taggant. Ensuite les gens pourront poster des réponses.

Pour le moment pas d'option de modération ou de pistage de prévu. pas de module d'administration encore créé. Mais le nessessaire dans les tables SQL est présent.

### Le projet est loin d'être terminé mais il dispose déjà du minimum syndical pour etre utilisé : 
* Inscription : OK
* Connection/Déconnection : OK
* Liste des discussions : OK
    * Selon leurs tags, via une recherche, filtrage : NON
* Vue des réponses à une discussion : OK
    * Filtrage des messages par auteur : NON
* Liste des utilisateurs : NON
    * Voir les détails d'un user (id pseudo email) : NON

Ce projet (personel) est sous-licence [CC-BY-NC-SA 3.0](https://creativecommons.org/licenses/by-nc-sa/3.0/fr/)

### Prérequis
* PHP 5.4+
* Mysql 5.x+

### Instalation (manuel) :
* Créer une BDD (interclassement UTF-8, pour le bien de l'humanité please)
* Éditer le fichier conf/Params.ini.php (n'oubliez pas de modifier le SALT !!)
* importer dans votre BDD le fichier bdd.sql
* Enjoy !

### À faire ensuite :
* Vous pouvez ajouter manuellement dans la table "Tags" des nouveaux tags
* Créer votre compte via le formulaire du site pour ensuite le passer admin (via la table "admin").
    * sert à poster des discussions sur des tags reservés aux admins.

# Merci au Framework mini-fwk

Mini-Framework PHP pour étudiants DUT INFO IUT-Amiens
Support pédagogique pour appréhender les bases du MVC

Inclus les librairies suivantes: 

    - moteur de template SMARTY
    - framework Twitter Bootstrap (3)
    - jquery/jqueryUI

développé par Mr Durand :    
[Framework](https://github.com/d-durand/mini-fwk)    
[Son GitHub](https://github.com/d-durand/)

###### Idées pour un nom final :
* Laper : à prononcer en anglais ce qui donne "La peur" phonétiquement. avec une mascotte de chacha de Wakfu. :p
* Perla : anagrame de parle.