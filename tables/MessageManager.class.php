<?php
/*
CREATE TABLE messages (   -- Les messages
    id          BIGINT          unsigned            NOT NULL            AUTO_INCREMENT,
    auteur      BIGINT          unsigned            NOT NULL                          ,
    discussion  BIGINT          unsigned            NOT NULL                          ,
    message     TEXT                                NOT NULL                          ,
    -- contraintes
    PRIMARY KEY (id),
    FOREIGN KEY(auteur) REFERENCES users(id),
    FOREIGN KEY(discussion) REFERENCES discussions(id)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE VIEW messagesEnhanced (
    id_mes, id_aut_mes, id_disc_mes, message,
        pseudo_mes, email_mes,
    titre, id_aut_disc,
        pseudo_disc, email_disc,
    tag
)
AS SELECT
    messages.id, messages.auteur, messages.discussion, messages.message,
        users.pseudo, users.email,
    discussions.titre, discussions.auteur,
        users.pseudo, users.email,
    tags.nom
FROM messages, users, discussions, tags
WHERE messages.auteur = users.id
AND messages.discussion = discussions.id
AND discussions.auteur = users.id
AND discussions.tag = tags.id ;
*/

class MessageManager {
		public static $table = "messagesEnhanced";

		public static function creer($m){
			$sql = "INSERT INTO messages VALUES (NULL,?, ?, ?)";
			$res = DB::get_instance()->prepare($sql);
			$res -> execute(array((int)$m->id_aut_mes, (int)$m->id_disc_mes, $m->message));
			$m->id = DB::get_instance()->lastInsertId();

			return $m;
		}

		public static function chercherParID($id) {
			$sql="SELECT * from ".self::$table." WHERE id_mes=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($id));

			if($res->rowCount()==0) return false;

			$m = $res->fetch(PDO::FETCH_ASSOC);
			$message =
			new Message(
				$m['id_aut_mes'], $m['id_disc_mes'], $m['message'], $m['id_mes'],
					$m['pseudo_mes'], $m['email_mes'],
				$m['titre'], $m['id_aut_disc'],
					$m['pseudo_disc'], $m['email_disc'],
				$m['tag']);

			return $discussion;
		}

		public static function listeFromAuteur($auteur){
			$sql=
			" SELECT * from ".self::$table.
			" WHERE id_aut_mes = ?".
			" OR pseudo_mes = ?";

			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($auteur, $auteur));

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($m 		= $res->fetch(PDO::FETCH_ASSOC)) {
				$message =
				new Message(
					$m['id_aut_mes'], $m['id_disc_mes'], $m['message'], $m['id_mes'],
						$m['pseudo_mes'], $m['email_mes'],
					$m['titre'], $m['id_aut_disc'],
						$m['pseudo_disc'], $m['email_disc'],
					$m['tag']);

				$tab[] = $message;
			}

			return $tab;
		}
		public static function listeFromDiscussion($discussion){
			$sql=
			" SELECT * from ".self::$table.
			" WHERE id_disc_mes = ? ".
			" OR titre = ? ";

			$res=DB::get_instance()->prepare($sql);
			$res->execute(array((int)$discussion, $discussion));

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($m 	 = $res->fetch(PDO::FETCH_ASSOC)) {
				$message =
				new Message(
					$m['id_aut_mes'], $m['id_disc_mes'], $m['message'], $m['id_mes'],
						$m['pseudo_mes'], $m['email_mes'],
					$m['titre'], $m['id_aut_disc'],
						$m['pseudo_disc'], $m['email_disc'],
					$m['tag']);

				$tab[] = $message;
			}

			return $tab;
		}
		public static function liste(){
			$sql="SELECT * FROM ".self::$table;
			$res=DB::get_instance()->prepare($sql);
			$res->execute();

			if($res->rowCount()==0) return false;

			$tab = array();
			while ($m 	 = $res->fetch(PDO::FETCH_ASSOC)) {
				$message =
				new Message(
					$m['id_aut_mes'], $m['id_disc_mes'], $m['message'], $m['id_mes'],
						$m['pseudo_mes'], $m['email_mes'],
					$m['titre'], $m['id_aut_disc'],
						$m['pseudo_disc'], $m['email_disc'],
					$m['tag']);


				$tab[] = $message;
			}

			return $tab;
		}

		public static function desactiver(){
			
		}

		public static function activer(){
			
		}
}

?>