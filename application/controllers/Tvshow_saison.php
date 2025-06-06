<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow_saison extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_saison');
		$this->load->helper('html');
		$this->load->helper('url');

	}

	public function saisonId($saisonId){
		$donneeSaison = $this->model_saison->getSaisonEtEpisode($saisonId);
		$saison_id = $donneeSaison[0]->saison_id;
		$tvshow_id = $donneeSaison[0]->tvshow_id;
		$jpeg_saison=$donneeSaison[0]->jpeg;
		$saison=$donneeSaison[0]->saison_name;
		$avis = $this->model_saison->getAvisSaison($tvshow_id,$saison_id);
		$nb_episodes=0;
		foreach($donneeSaison as $row){
			$episodes[] = [
				'id' => $row->episode_id,
				'name' => $row->episode_name,
				'ep_number' => $row->episodeNumber,
				'description' => $row->description,
			];
			$nb_episodes++;
		}
		$donnee = [
			'saison' => $saison,
			'jpeg' => $jpeg_saison,
			'episodes' => $episodes,
			'nb_episodes' => $nb_episodes,
			'avis' => $avis,
			'message' => null,
		];

		if ($this->input->post('envoyer')){

			$titre = trim(strip_tags($this->input->post('titre')));
			$description = trim(strip_tags($this->input->post('description')));
			$note = trim(strip_tags($this->input->post('avis')));
			if ((isset($_SESSION['connection']) && $_SESSION['connection'])){
				$info['note'] = $note;
    			$info['prenom'] = $_SESSION['prenom'];;
    			$info['nom'] = $_SESSION['nom'];;
    			$info['id'] = $tvshow_id;
				$info['titre'] = $titre;
				$info['description'] = $description;
				$info['user_id'] = $_SESSION['id'];
				$info['season_id'] = $saison_id;
				$this->model_saison->setAvis($info);
				redirect('Tvshow_saison/saisonId/'.$saisonId);
			}else{
				$donnee['message']="Vous avez besoin d'un compte pour ajouter un avis !"; 
			}
		}

		$this->load->view('layout/header');
		$this->load->view('tvshow_saison', $donnee);
		$this->load->view('layout/footer');
		
	}
}
