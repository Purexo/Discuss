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

class Message {
		public $id_mes;
        public $id_aut_mes;
        public $id_disc_mes;
        public $message;
        /* --- surcharge de champs --- */
            public $pseudo_mes; 
            public $email_mes;
        public $titre;
        public $id_aut_disc;
            public $pseudo_disc;
            public $email_disc;
        public $tag;
		
		public function __construct($id_aut_mes=NULL, $id_disc_mes=NULL, $message=NULL, $id_mes=NULL,
                $pseudo_mes=NULL, $email_mes=NULL,
            $titre=NULL, $id_aut_disc=NULL,
                $pseudo_disc=NULL, $email_disc=NULL,
            $tag=NULL
            ){
            // --- Etat minimum --- //
			$this->id_mes        = (int)     $id_mes;
			$this->id_aut_mes    = (int)     $id_aut_mes;
            $this->id_disc_mes   = (int)     $id_disc_mes;
            $this->message       = (string)  $message;
            // --- Surcharge --- //
                $this->pseudo_mes    = (string) $pseudo_mes;
                $this->email_mes     = (string) $email_mes;
            $this->titre             = (string) $titre;
            $this->id_aut_disc       = (int)    $id_aut_disc;
                $this->pseudo_disc   = (string) $pseudo_disc;
                $this->email_disc    = (string) $email_disc;
            $this->tag               = (string) $tag;
            // --- Etat Max--- //
		}
}

?>