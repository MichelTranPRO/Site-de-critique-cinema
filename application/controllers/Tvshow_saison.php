<?php
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
		$jpeg_saison=$donneeSaison[0]->jpeg;
		$saison=$donneeSaison[0]->saison_name;
		$nb_episodes=0;
		foreach($donneeSaison as $row){
			$episodes[] = [
				'id' => $row->episode_id,
				'name' => $row->episode_name,
				'ep_number' => $row->episodeNumber,
				//'jpeg_saison' => $row->jpeg,
				'description' => $row->description,
			];
			$nb_episodes++;
		}
		$donnee = [
			'saison' => $saison,
			'jpeg' => $jpeg_saison,
			'episodes' => $episodes,
			'nb_episodes' => $nb_episodes,
		];

		$this->load->view('layout/header');
		$this->load->view('tvshow_saison', $donnee);
		$this->load->view('layout/footer');
		
	}
}
