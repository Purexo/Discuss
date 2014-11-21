<?php
//exemple de table Membre
/*
//structure SQL :CREATE TABLE users (         -- Liste des utilisateurs
    id          BIGINT          unsigned            NOT NULL            AUTO_INCREMENT,
    login       VARCHAR(20)                         NOT NULL                          ,
    pseudo      VARCHAR(20)                         NOT NULL                          ,
    email       VARCHAR(255)                        NOT NULL                          ,
    mdp         VARCHAR(535)                        NOT NULL                          ,
    -- contraintes
    PRIMARY KEY (id),
    UNIQUE KEY (login, pseudo, email)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;
*/



//classe de gestion des entités User
class UserManager {
		public static $table = "users";

		public static function creer($u){
			$sql = "INSERT INTO ".self::$table." VALUES (NULL,?, ?, ?, ?)";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array($u->login, $u->pseudo, $u->email, $u->mdp));
			$u->id=DB::get_instance()->lastInsertId();

			return $u;
		}

		public static function chercherParID($id) {
			$sql="SELECT id, login, pseudo, email from ".self::$table." WHERE id=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}

			$u 				= $res->fetch(PDO::FETCH_ASSOC);
			$user 			= new User($u['login'], $u['pseudo'], $u['email'], $u['id']);

			return $user;
		}

		public static function chercherParLogin($login){
			$sql="SELECT * from ".self::$table." WHERE login=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($login));
			
			if($res->rowCount()==0) return false;//gérer les erreurs éventuelles

			$u 				= $res->fetch(PDO::FETCH_ASSOC);
			$user 			= new User($u['login'], $u['pseudo'], $u['email'], $u['mdp'], $u['id']);
			// l'user existe deja dans la bdd son mdp est deja hashé
			// donc on ecrase le surhashage du password
			$user->mdp = $u['mdp']; 

			return $user;
		}

		//autres exemples de fonctions possibles
		public static function liste(){
			$sql="SELECT id, login, pseudo, email from ".self::$table;
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($login));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				return false;
			}

			$tab = array();
			while ($u = $res->fetch(PDO::FETCH_ASSOC)) {
				$user = new User($u['login'], $u['pseudo'], $u['email'], $u['id']);

				$tab[] = $user;
			}
			return $tab;
		}

		public static function desactiver(){
			
		}

		public static function activer(){
			
		}
}

?>