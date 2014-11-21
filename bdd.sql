-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
--
-- créer un service forum rapide convivial et minimaliste
-- juste un système de tag de topic et de message avec des user et un peu d'administration
-- Table : users, admins, discussions, messages, tags
--
-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

CREATE TABLE users (         -- Liste des utilisateurs
    id          BIGINT          unsigned            NOT NULL            AUTO_INCREMENT,
    login       VARCHAR(20)                         NOT NULL                          ,
    pseudo      VARCHAR(20)                         NOT NULL                          ,
    email       VARCHAR(255)                        NOT NULL                          ,
    mdp         VARCHAR(535)                        NOT NULL                          ,
    -- contraintes
    PRIMARY KEY (id),
    UNIQUE KEY (login, pseudo, email)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE admins (        -- Détermine la liste des admins
    id          BIGINT          unsigned            NOT NULL                         ,
    -- contraintes
    PRIMARY KEY (id),
    FOREIGN KEY(id) REFERENCES users(id)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE tags (          -- Catégories (repere visuel + critere de recherche)
    id          BIGINT          unsigned            NOT NULL            AUTO_INCREMENT,
    nom         VARCHAR(30)                         NOT NULL                          ,
    isadmin     TINYINT(1)                          NOT NULL                          ,
    -- contraintes
    PRIMARY KEY (id),
    UNIQUE KEY (nom)
)   ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `tags` CHANGE `isadmin` `isadmin` TINYINT(1) NOT NULL DEFAULT 0;
INSERT INTO `tags` (`id`, `nom`, `isadmin`) VALUES
(1, 'important', 1),
(2, 'Informatique', 0),
(3, 'loisir', 0);

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

-- ======================================================================
--
--  Création des vues
--  Permet d'avoir des requetes SELECT toute prete
--  aux quelles on prend ce que l'on veut 
--  ainsi obtenir les attributs d'une table via une clé étrangère
--
-- ======================================================================

CREATE VIEW messagesEnhanced (
    id_mes, id_aut_mes, id_disc_mes, message,
        pseudo_mes, email_mes,
    titre, id_aut_disc,
        pseudo_disc, email_disc,
    tag
)
AS SELECT
    messages.id, messages.auteur, messages.discussion, messages.message,
        userMes.pseudo, userMes.email,
    discussions.titre, discussions.auteur,
        userDisc.pseudo, userDisc.email,
    tags.nom
FROM messages, users userMes, discussions, users userDisc, tags
WHERE messages.auteur = userMes.id
AND messages.discussion = discussions.id
AND discussions.auteur = userDisc.id
AND discussions.tag = tags.id ;


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