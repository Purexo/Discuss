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

class Tag {
		public $id;
        public $nom;
        public $isadmin;
		
		public function __construct($nom=NULL, $isadmin=NULL, $id=NULL){
			$this->id        = $id;			
			$this->nom       = $nom;
			$this->isadmin   = $isadmin;
		}
}

?>