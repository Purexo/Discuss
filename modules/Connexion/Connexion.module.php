<?php
class Connexion extends Module{
			

	public function action_login(){

		// A FAIRE
		// verifier les donnees de connexion
		//charger le membre
		//$user=Membre::chercherParId(/*mettre l'id*/);
		//$this->session->ouvrir($user);
		
		//code de demo
		$err = true;
		$user = UserManager::chercherParLogin($this->req->Login);
		if ($user) {
			if ($user->mdp == hash_hmac(ALGO, SALT . $this->req->Pass . $user->pseudo, $user->login)) {
				$this->session->user=$user;
				$this->tpl->assign('login',$user->login);
				$this->session->ouvrir($user);
				$this->site->ajouter_message("Vous êtes connecté en tant que ".$user->login);
				$this->site->redirect("index");
				$err = false;
			}
		}
		if ($err) 
			$this->site->ajouter_message
				("Echec de la connection \n".
				 "Mauvais password ou login");
	}

	public function action_deconnect(){		
		$this->site->ajouter_message('Vous êtes déconnecté');							
		$this->session->fermer(); 			
		$this->site->redirect("index");
	}

}
?>