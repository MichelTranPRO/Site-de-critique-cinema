<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_saison extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

    public function getSaisonEtEpisode($saisonId){
		$query = $this->db->query("
			SELECT s.id AS saison_id, s.name AS saison_name, e.id AS episode_id, e.name AS episode_name, e.episodeNumber,  p.jpeg, e.overview AS description
        	FROM season s
        	JOIN episode e ON e.seasonId = s.id
			JOIN poster p ON p.id = s.posterId
        	WHERE e.seasonid = ?
			ORDER BY s.id, e.episodeNumber
		", [$saisonId]);
		return $query->result();
	}   
}
