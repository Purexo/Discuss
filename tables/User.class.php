<?php
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



//exemple de classe en relation avec la table
class User {
		public $id;
		public $login;
		public $pseudo;
		public $email;
		public $mdp;
		
		public function __construct($login=NULL, $pseudo=NULL, $email=NULL, $mdp=NULL, $id=NULL){
			$this->id        = $id;			
			$this->login     = $login;
			$this->pseudo    = $pseudo;
			$this->email     = $email;
            $this->mdp       = hash_hmac(ALGO, SALT . $mdp . $this->pseudo, $this->login); // salé poivré MACé
		}
}

?>