<?php
/*
CREATE TABLE discussions (   -- Les discussions
    id          BIGINT          unsigned            NOT NULL            AUTO_INCREMENT,
    auteur      BIGINT          unsigned            NOT NULL                          ,
    tag         BIGINT          unsigned            NOT NULL                          ,
    titre       VARCHAR(255)                        NOT NULL                          ,
    -- contraintes
    PRIMARY KEY (id),
    FOREIGN KEY(auteur) REFERENCES users(id),
    FOREIGN KEY(tag) REFERENCES tags(id)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE VIEW discussionsEnhanced (
    id_disc, id_auteur_disc, id_tag_disc, titre,
        pseudo_auteur, email_auteur,
        nom_tag
)
AS SELECT
    discussions.id, discussions.auteur, discussions.tag, discussions.titre,
        users.pseudo, users.email,
        tags.nom
FROM discussions, users, tags
WHERE discussions.auteur = users.id
AND discussions.tag = tags.id;
*/

class DiscussionManager {
		public static $table = "discussionsEnhanced";

		public static function creer($d){
			$sql = "INSERT INTO discussions VALUES (NULL,?, ?, ?)";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array($d->id_auteur_disc, $d->id_tag_disc, $d->titre));
			$d->id=DB::get_instance()->lastInsertId();

			return $d;
		}

		public static function chercherParID($id) {
			$sql="SELECT * from ".self::$table." WHERE id_disc=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));

			if($res->rowCount()==0) return false;

			$d 				= $res->fetch(PDO::FETCH_ASSOC);
			$discussion		= new Discussion
			($d['id_auteur_disc'], $d['id_tag_disc'], $d['titre'], $d['id_disc'],
			 $d['pseudo_auteur'], $d['email_auteur'],
			 $d['nom_tag']);

			return $discussion;
		}

		public static function chercherParTitre($titre){
			$sql="SELECT * from ".self::$table." WHERE titre=? LIMIT 1";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($titre));

			if($res->rowCount()==0) return false;

			$d 				= $res->fetch(PDO::FETCH_ASSOC);
			$discussion		= new Discussion
			($d['id_auteur_disc'], $d['id_tag_disc'], $d['titre'], $d['id_disc'],
			 $d['pseudo_auteur'], $d['email_auteur'],
			 $d['nom_tag']);

			return $discussion;
		}

		//autres exemples de fonctions possibles
		public static function liste(){
			$sql="SELECT * from ".self::$table;
			$res=DB::get_instance()->prepare($sql);
			$res->execute();

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($d 			= $res->fetch(PDO::FETCH_ASSOC)) {
				$discussion		= new Discussion();
				$discussion->id_auteur_disc = $d['id_auteur_disc'];
				$discussion->id_tag_disc 	= $d['id_tag_disc'];
				$discussion->titre 			= $d['titre'];
				$discussion->id_disc 		= $d['id_disc'];
				$discussion->pseudo_auteur 	= $d['pseudo_auteur'];
				$discussion->email_auteur 	= $d['email_auteur'];
				$discussion->nom_tag 		= $d['nom_tag'];
				$discussion->id_auteur_disc = $d['id_auteur_disc'];

				$tab[] = $discussion;
			}

			return $tab;
		}
		public static function listeFromTag($tag){
			$sql=
			"SELECT * from ".self::$table.
			" Where nom_tag = ?".
			" OR id_tag_disc = ?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($tag, (int)$tag));

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($d 			= $res->fetch(PDO::FETCH_ASSOC)) {
				$discussion		= new Discussion
				($d['id_auteur_disc'], $d['id_tag_disc'], $d['titre'], $d['id_disc'],
				 $d['pseudo_auteur'], $d['email_auteur'],
				 $d['nom_tag']);

				$tab[] = $discussion;
			}

			return $tab;
		}
		public static function listeFromAuteur($auteur){
			$sql=
			"SELECT * from ".self::$table.
			"WHERE pseudo_auteur = ? ".
			"OR id_auteur_disc = ? ";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($auteur, (int)$auteur));

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($d 			= $res->fetch(PDO::FETCH_ASSOC)) {
				$discussion		= new Discussion
				($d['id_auteur_disc'], $d['id_tag_disc'], $d['titre'], $d['id_disc'],
				 $d['pseudo_auteur'], $d['email_auteur'],
				 $d['nom_tag']);

				$tab[] = $discussion;
			}

			return $tab;
		}

		public static function desactiver(){
			
		}

		public static function activer(){
			
		}
}

?>