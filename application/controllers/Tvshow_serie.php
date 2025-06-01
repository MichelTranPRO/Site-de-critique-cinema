<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow_serie extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_page_serie');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function id($id){
		$tvshow = $this->model_page_serie->getSerie($id);
		
		$genre = $this->model_page_serie->getGenre($id);
		$donneeSaison = $this->model_page_serie->getSaisonEtEpisode($id);

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
			'saisonEtEpisode' => $saisonEtEpisode
		];

		$this->load->view('layout/header');
		$this->load->view('tvshow_page_serie', $donnee);
		$this->load->view('layout/footer');
		
	}

}
