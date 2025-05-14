<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_tvshow');

	}
	public function index(){
		$tvshow = $this->model_tvshow->getTvshow();
		$this->load->view('layout/header');
		$this->load->view('tvshow_list',['tvshow'=>$tvshow]);
		$this->load->view('layout/footer');
	}
}
