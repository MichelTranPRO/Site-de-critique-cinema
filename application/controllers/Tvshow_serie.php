<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow_serie extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_page_serie');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function id($id){
		$message=[];
		$tvshow = $this->model_page_serie->getSerie($id);
		$genre = $this->model_page_serie->getGenre($id);
		$donneeSaison = $this->model_page_serie->getSaisonEtEpisode($id);
		$avis = $this->model_page_serie->getAvisSerie($id);

		$saisonEtEpisode = [];
		foreach($donneeSaison as $row){
			$Saison = $row->saison_name;
			$saisonEtEpisode[$Saison][] = [
				'id' => $row->episode_id,
				'name' => $row->episode_name,
				'ep_number' => $row->episodeNumber,
				'jpeg_saison' => $row->jpeg,
				'saisonId' => $row->saison_id,
			];
		}

		$donnee = [
			'tvshow' => $tvshow,
			'genre' => $genre,
			'saisonEtEpisode' => $saisonEtEpisode,
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
    			$info['id'] = $id;
				$info['titre'] = $titre;
				$info['description'] = $description;
				$info['user_id'] = $_SESSION['id'];
				$this->model_page_serie->setAvis($info);
				redirect('Tvshow_serie/id/'.$id);
			}else{
				$donnee['message']="Vous avez besoin d'un compte pour ajouter un avis !"; 
			}
		}
		

		$this->load->view('layout/header');
		$this->load->view('tvshow_page_serie', $donnee);
		$this->load->view('layout/footer');
		
	}

}
