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

class Discussion {
		public $id_disc;
        public $id_auteur_disc;
        public $id_tag_disc;
        public $titre;
        // --- Surcharge --- //
        public $pseudo_auteur;
        public $email_auteur;
        public $nom_tag;
		
		public function __construct
        ($id_auteur_disc=NULL, $id_tag_disc=NULL, $titre=NULL, $id_disc=NULL,
         $pseudo_auteur=NULL, $email_auteur=NULL,
         $nom_tag=NULL){
			$this->id_disc        = (int)$id_disc;			
			$this->id_auteur_disc = (int)$id_auteur_disc;
            $this->id_tag_disc    = (int)$id_tag_disc;
            $this->titre          = $titre;
            // --- Surcharge --- //
            $this->pseudo_auteur  = $pseudo_auteur;
            $this->email_auteur   = $email_auteur;
            $this->nom_tag        = $nom_tag;
		}
}

?>