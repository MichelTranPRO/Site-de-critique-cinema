<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_tvshow');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function index(){
		$tvshow = $this->model_tvshow->getTvshow();
		if ($this->input->get('search')){
			$nomRecherche = trim(strip_tags($this->input->get('search')));
			$nomRecherche = '%'.$nomRecherche.'%';
			$tvshow = $this->model_tvshow->recherche($nomRecherche);
		}
		$this->load->view('layout/header');
		$this->load->view('tvshow_list',['tvshow'=>$tvshow]);
		$this->load->view('layout/footer');
	}
}

