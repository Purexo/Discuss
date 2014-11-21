<?php
    
    Class Discussions extends Module {

        public function action_index() {
            $discussions = DiscussionManager::liste();

            $this->tpl->assign("discussions", $discussions);
            $this->set_title(SITENAME . " : Les discussions");
        }

        public function action_view() {
            $id=(int)$this->req->id;
            $discussion = DiscussionManager::chercherParID($id);
            $auteur = UserManager::chercherParID($discussion->id_auteur_disc);
            $messages = MessageManager::listeFromDiscussion($id); // tableau de MessageEnhanced

            $this->tpl->assign("discussion", $discussion);
            $this->tpl->assign("messages", $messages);
            $this->tpl->assign("auteur", $auteur);

            $f = new Form("?module=Discussions&action=message","form_message");
                $f->add_textarea("message","message","Réponse : ")->set_required();
                $f->add_submit("Envoyer","bntval")->set_value('Envoyer');

            $this->set_title(SITENAME . " " . $discussion->titre);
            $this->tpl->assign("form",$f);
            $this->session->form = $f;
            $this->session->discussion = $id;
        }

        public function action_new() {
            $this->set_title(SITENAME . " : Nouvelle Discussion");

            $tag = TagManager::listeNonAdminIdNom();

            $f = new Form("?module=Discussions&action=validation","form_discussions");
                $f->add_text("titre","titre","Titre : ")->set_required();
                $f->add_select("tag", "tag", "Tag :", $tag)->set_required();
                $f->add_textarea("message","message","Message : ")->set_required();
                $f->add_submit("Envoyer","bntval")->set_value('Envoyer');

            $this->tpl->assign("form",$f);
            $this->session->form = $f;
        }

        /* ------------------------ Validation des informations ------------------------ */
        public function action_validation() {
            $this->set_title("Validation de la discussion");
            $err=false;
            //on récupère la structure du formulaire précédemment stocké dans la session
            $form=$this->session->form;
            $form->reset_errors();
            $form->check();

            if($this->requete->titre == ''){
                $err=true;
                $form->titre->set_error(true);
                $form->titre->set_error_message("champ vide !");
            }
            if($this->requete->tag == ''){
                $err=true;
                $form->tag->set_error(true);
                $form->tag->set_error_message("champ vide !");
            }
            if($this->requete->message == ''){
                $err=true;
                $form->message->set_error(true);
                $form->message->set_error_message("champ vide !");
            }

            if($err){        
                $this->site->ajouter_message('contrôle form : remplir les champs',ALERTE);
                $form->populate();      
                $this->tpl->assign("form",$form);
            }
            else {
                $tab = Secure::htmlentitiesOnArray( array(
                    "titre" => $_POST['titre'],
                    "tag" => $_POST['tag'],
                    "message" => $_POST['message'])
                );
                $auteur = $this->session->user->id;
                $discussion = new Discussion($auteur, $tab["tag"], $tab["titre"]);
                DiscussionManager::creer($discussion);

                $message = new Message($auteur, $discussion->id, $tab["message"]);
                MessageManager::creer($message);
            }
        }

        public function action_message() {
            $this->set_title("Validation du message");
            $err=false;
            //on récupère la structure du formulaire précédemment stocké dans la session
            $form=$this->session->form;
            $form->reset_errors();
            $form->check();

            if($this->requete->message == ''){
                $err=true;
                $form->titre->set_error(true);
                $form->titre->set_error_message("Message vide...");
            }
            if($err){        
                $this->site->ajouter_message('contrôle form : remplir les champs',ALERTE);
                $form->populate();      
                $this->tpl->assign("form",$form);
            }
            else {
                $tab = Secure::htmlentitiesOnArray( array(
                    "message" => $this->requete->message)
                );
                $auteur = $this->session->user->id;
                $id = $this->session->discussion;

                $message = new Message($auteur, $id, $tab["message"]);
                var_dump($message);
                MessageManager::creer($message);
                //$this->site->redirect("Discussions", "view&id=".$id);
            }
        }
        /* ------------------------ /Validation des informations ------------------------ */
    }

?>