<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow_serie extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_tvshow');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function id($id){
		$tvshow = $this->model_tvshow->getSerie($id);
		$genre = $this->model_tvshow->getGenre($id);
		$donnee = [
			'tvshow' => $tvshow,
			'genre' => $genre
		];

		$this->load->view('layout/header');
		$this->load->view('tvshow_page_serie', $donnee);
		$this->load->view('layout/footer');
	}

}
