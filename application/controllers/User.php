<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_user');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function login(){
		if (isset($_SESSION['connection']) && $_SESSION['connection']){
			redirect("user/compte");
		}
		$donnee=[];
		if($this->input->post('envoyer')){
			$email = trim(strip_tags($this->input->post('email')));
			$mdp = trim(strip_tags($this->input->post('mdp')));
			$email_verif=$this->model_user->getEmail($email);
			
			if($email_verif !== null){
				$donnee['email']=$email;
				$prenom_nom=$this->model_user->getPrenomNom($email);
				$db_mdp=$this->model_user->getMDP($email);
				$mdp_hash=$db_mdp->mot_de_passe;
				if (password_verify($mdp, $mdp_hash)){
					$_SESSION=[
						'connection' => true,
						'email' => $email,
						'prenom' => $prenom_nom->prenom,
						'nom' => $prenom_nom->nom,

					];
					redirect('user/compte');
				}
				else{
					$donnee['email']= $email;
					$message['erreur_mdp']= "Mot de passe invalide.";
				}
			}
			else{
				$message['erreur_email']="Adresse e-mail invalide. Veuillez vous inscrire.";
			}
			$donnee['message']=$message;

		}

		$this->load->view('layout/header');
		$this->load->view('login',$donnee);
		$this->load->view('layout/footer');
	}
	public function register(){
		$message=[];
		$donnee=[];
		
		if ($this->input->post('envoyer')){
			$email = trim(strip_tags($this->input->post('email')));
			$email_verif = $this->model_user->getEmail($email);
			$mdp = trim(strip_tags($this->input->post('mdp')));
			$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
			$prenom = trim(strip_tags($this->input->post('prenom')));
			$nom = trim(strip_tags($this->input->post('nom')));

			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$message['email'] = "Adresse mail invalide.";
			}
			if ($email == $email_verif->email){
				$message['erreur_email']= "Erreur adresse e-mail déjà associée";
			}
			
			if ((empty($message))){
    			$donnee['email'] = $email;
    			$donnee['prenom'] = $prenom;
    			$donnee['nom'] = $nom;
    			$donnee['mdp'] = $mdp_hash;
    			$this->model_user->setInfo($donnee);
				redirect('user/login');
				
    		}
			$donnee['prenom'] = $prenom;
			$donnee['nom'] = $nom;
			$donnee['message']=$message;
			

		}

		$this->load->view('layout/header');
		$this->load->view('register',$donnee);
		$this->load->view('layout/footer');
	}
	public function compte(){
		$donnee;
		if ($_SESSION['connection'] === true){

			$this->load->view('layout/header');
			$this->load->view('compte');
			$this->load->view('layout/footer');
		}
		else{
			redirect('user/login');
		}
	}
	public function logout(){
		session_destroy();
		$_SESSION = [];
		redirect("/");
	}

}