<?php
/*
CREATE TABLE tags (          -- Catégories (repere visuel + critere de recherche)
    id          BIGINT          unsigned            NOT NULL            AUTO_INCREMENT,
    nom         VARCHAR(30)                         NOT NULL                          ,
    isadmin     TINYINT(1)                          NOT NULL                          ,
    -- contraintes
    PRIMARY KEY (id),
    UNIQUE KEY (nom)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `tags` CHANGE `isadmin` `isadmin` TINYINT(1) NOT NULL DEFAULT 0;
*/

class TagManager {
		public static $table = "tags";

		public static function creer($t){
			$sql = "INSERT INTO ".self::$table." VALUES (NULL,?, ?)";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array($t->nom, $t->isadmin));
			$t->id=DB::get_instance()->lastInsertId();

			return $t;
		}

		public static function chercherParID($id) {
			$sql="SELECT * from ".self::$table." WHERE id=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));

			if($res->rowCount()==0) return false;

			$t 				= $res->fetch(PDO::FETCH_ASSOC);
			$tag 			= new Tag($t['nom'], $t['isadmin'], $t['id']);

			return $tag;
		}

		public static function chercherParNom($nom){
			$sql="SELECT * from ".self::$table." WHERE nom=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($nom));

			if($res->rowCount()==0) return false;

			$t 				= $res->fetch(PDO::FETCH_ASSOC);
			$tag 			= new Tag($t['nom'], $t['isadmin'], $t['id']);

			return $tag;
		}

		//autres exemples de fonctions possibles
		public static function liste(){
			$sql="SELECT * from ".self::$table;
			$res=DB::get_instance()->prepare($sql);
			$res->execute();

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($t 			= $res->fetch(PDO::FETCH_ASSOC)) {
				$tag 			= new Tag($t['nom'], $t['isadmin'], $t['id']);

				$tab[] = $tag;
			}

			return $tab;
		}
		public static function listeAdmin(){
			$sql="SELECT id, nom from ".self::$table." WHERE isadmin = 1";
			$res=DB::get_instance()->prepare($sql);
			$res->execute();

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($t 			= $res->fetch(PDO::FETCH_ASSOC)) {
				$tag 			= new Tag($t['nom'], 1, $t['id']);

				$tab[] = $tag;
			}

			return $tab;
		}
		public static function listeNonAdmin(){
			$sql="SELECT id, nom from ".self::$table." WHERE isadmin = 0";
			$res=DB::get_instance()->prepare($sql);
			$res->execute();

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($t 			= $res->fetch(PDO::FETCH_ASSOC)) {
				$tag 			= new Tag($t['nom'], 0, $t['id']);

				$tab[] = $tag;
			}

			return $tab;
		}
		public static function listeNonAdminIdNom(){
			/*
			* Retourne les tags dans un tableau assossiatif : "id" => nom
			*/
			$sql="SELECT id, nom from ".self::$table." WHERE isadmin = 0";
			$res=DB::get_instance()->prepare($sql);
			$res->execute();

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($t = $res->fetch(PDO::FETCH_ASSOC)) {
				$tag  = new Tag($t['nom'], 0, $t['id']);

				$id = $tag->id;
				$tab["$id"] = $tag->nom;
			}

			return $tab;
		}

		public static function desactiver(){
			
		}

		public static function activer(){
			
		}
}

?>