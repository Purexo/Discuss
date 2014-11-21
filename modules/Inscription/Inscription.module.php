<?php
    
    Class Inscription extends Module {

        /* ------------------------ Formulaire d'inscription ------------------------ */
        public function action_index() {
            $this->set_title("Formulaire d'inscription");

            $f=new Form("?module=Inscription&action=validation","form_inscription");
                $f->add_text("login","login","Login")->set_required();
                $f->add_text("pseudo","pseudo","Pseudo")->set_required();
                $f->add_text("email","email","e-m@il")->set_required();
                $f->add_password("pass1","pass1","Password")->set_required();
                $f->add_password("pass2","pass2","retapez...")->set_required();

                $f->pass1->set_validation("min-length:8");
                $f->pass2->set_validation("equals-field:pass1");

                $f->add_submit("Valider","bntval")->set_value('Valider');


            $this->tpl->assign("form",$f);
            $this->session->form = $f;
        }

        /* ------------------------ Validation des informations ------------------------ */
        public function action_validation() {
            $this->set_title("Validation de l'inscription");
            $err=false;
            //on récupère la structure du formulaire précédemment stocké dans la session
            $form=$this->session->form;
            $form->reset_errors();
            $form->check();

            if($this->requete->login == ''){
                $err=true;
                $form->login->set_error(true);
                $form->login->set_error_message("champ vide !");
            }
            if($this->requete->pseudo == ''){
                $err=true;
                $form->pseudo->set_error(true);
                $form->pseudo->set_error_message("champ vide !");
            }

            if(!filter_var($this->requete->email, FILTER_VALIDATE_EMAIL)){
                $err=true;
                $form->email->set_error(true);
                $form->email->set_error_message("adresse mail non conforme");
            }

            if($err){        
                $this->site->ajouter_message('contrôle form : remplir les champs (uniquement login dans cet exemple)',ALERTE);
                // on pré-remplit avec les valeurs déjà saisies
                $form->populate();      
                // passe le formulaire dans le template sous le nom "form"
                $this->tpl->assign("form",$form);
            }
            else {/*
                $taba = array($_POST['login'], $_POST['pseudo'], $_POST['email'], $_POST['pass1']);
                $tab = array();
                foreach ($taba as $value) $tab[] = htmlentities($value);*/

                $tab = Secure::htmlentitiesOnArray(array($_POST['login'], $_POST['pseudo'], $_POST['email'], $_POST['pass1']));

                $user = new User($tab[0], $tab[1], $tab[2], $tab[3]);

                UserManager::creer($user);
            }
        }
        
    }

?>