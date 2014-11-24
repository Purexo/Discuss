<?php
    
    Class Utilisateur extends Module {

        public function action_index() {
            $users = UserManager::liste();
            
            $this->tpl->assign("users", $users);
            $this->set_title(SITENAME . " : Les Utilisateurs");
        }

        public function action_view() {
            $id=(int)$this->req->id;
            $user = UserManager::chercherParID($id);

            $this->tpl->assign("user", $user);

            $this->set_title(SITENAME . " : " . $user->pseudo);
        }
    }

?>