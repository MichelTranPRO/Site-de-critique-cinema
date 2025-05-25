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
			JOIN poster ON tvshow.posterId = poster.id"
		);
		return $query->result();
	}

	/* fonction pour donner des données en fonction de l'id */
	public function getSerie($id){
    	$query = $this->db->query("
        	SELECT tvshow.name,tvshow.id,tvshow.homepage,tvshow.overview,jpeg,COUNT(season.id) AS nbSaisons
        	FROM tvshow 
        	JOIN poster ON tvshow.posterId = poster.id
        	LEFT JOIN season ON season.tvShowId = tvshow.id
        	WHERE tvshow.id = ?
    		", [$id]);
    	return $query->row();
    }
	public function getGenre($id){
		$query = $this->db->query("
		SELECT genre.name as genres
		FROM genre 
		JOIN tvshow_genre ON genre.id = tvshow_genre.genreId
		WHERE tvshowId = ?
		", [$id]);
		return $query->result();
	}
}
