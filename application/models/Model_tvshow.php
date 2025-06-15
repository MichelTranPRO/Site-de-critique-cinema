<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_tvshow extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getTvshow(){
		$query = $this->db->query("
			SELECT tvshow.name,tvshow.id,jpeg,
					(SELECT COUNT(*) from season
					 WHERE season.tvShowId = tvshow.id) as nb
			FROM tvshow
			JOIN poster ON tvshow.posterId = poster.id
			");
		return $query->result();
	}

	public function recherche($nomRecherche){
		$query = $this->db->query("
			SELECT tvshow.name,tvshow.id,jpeg, 
					(SELECT COUNT(*) from season
					 WHERE season.tvShowId = tvshow.id) as nb
			FROM tvshow JOIN poster ON tvshow.posterId = poster.id
			WHERE name LIKE ?
		", [$nomRecherche]);
		return $query->result();
	}

	public function getGenre(){
		$query = $this->db->query("
			SELECT DISTINCT name , genreId
			FROM genre 
			JOIN tvshow_genre ON genre.id = tvshow_genre.genreId
		");
		return $query->result();
	}
	public function genreRecherche($genreId){ 
		$query = $this->db->query("
			SELECT tvshow.name,tvshow.id,jpeg, 
					(SELECT COUNT(*) from season
					 WHERE season.tvShowId = tvshow.id) as nb
			FROM tvshow JOIN poster ON tvshow.posterId = poster.id
            JOIN tvshow_genre ON tvshow.id = tvshow_genre.tvShowId
			WHERE genreId = ?
		", [$genreId]);
		return $query->result();
	}

}
