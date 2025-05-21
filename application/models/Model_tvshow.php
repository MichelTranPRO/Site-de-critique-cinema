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
        	SELECT tvshow.name,tvshow.id,jpeg,COUNT(season.id) AS nb
        	FROM tvshow
        	JOIN poster ON tvshow.posterId = poster.id
        	LEFT JOIN season ON season.tvShowId = tvshow.id
        	WHERE tvshow.id = ?
        	GROUP BY tvshow.id, tvshow.name, jpeg
    		", [$id]);
    	return $query->row();
    }
}
