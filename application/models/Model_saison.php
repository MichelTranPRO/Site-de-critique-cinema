<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_saison extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

    public function getSaisonEtEpisode($saisonId){
		$query = $this->db->query("
			SELECT s.id AS saison_id, s.tvshowId AS tvshow_id, s.name AS saison_name, e.id AS episode_id, e.name AS episode_name, e.episodeNumber,  p.jpeg, e.overview AS description
        	FROM season s
        	JOIN episode e ON e.seasonId = s.id
			JOIN poster p ON p.id = s.posterId
        	WHERE e.seasonid = ?
			ORDER BY s.id, e.episodeNumber
		", [$saisonId]);
		return $query->result();
	}   
	public function getAvisSaison($tvshow_id, $saison_id){
		$query = $this->db->query("
			SELECT a.titre, a.note, a.description, u.nom, u.prenom
			FROM avis a JOIN user u ON a.user_id=u.id
			WHERE tvshow_id = ?
			AND season_id = ?
		", [$tvshow_id,$saison_id]);
		return $query->result();
	}
	public function setAvis($info){
		$query = $this->db->query("
		INSERT INTO avis (titre,description,note,tvshow_id,user_id,season_id)
		VALUES (?,?,?,?,?,?)
		",[
			$info['titre'],
			$info['description'], 
			$info['note'], 
			$info['id'],
			$info['user_id'],
			$info['season_id'],
		]);
	}
}
