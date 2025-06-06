<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_page_serie extends CI_Model {
	public function __construct(){
		$this->load->database();
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
	public function getSaisonEtEpisode($id){
		$query = $this->db->query("
			SELECT s.id AS saison_id, s.name AS saison_name, e.id AS episode_id, e.name AS episode_name, e.episodeNumber,  p.jpeg 
        	FROM season s
        	JOIN episode e ON e.seasonId = s.id
			JOIN poster p ON p.id = s.posterId
        	WHERE s.tvShowId = ?
			ORDER BY s.id, e.episodeNumber
		", [$id]);
		return $query->result();
	}
	public function getAvisSerie($id){
		$query = $this->db->query("
			SELECT a.titre, a.note, a.description, u.nom, u.prenom
			FROM avis a JOIN user u ON a.user_id=u.id
			WHERE tvshow_id = ?
			AND season_id IS null
		", [$id]);
		return $query->result();
	}
	public function setAvis($info){
		$query = $this->db->query("
		INSERT INTO avis (titre,description,note,tvshow_id,user_id)
		VALUES (?,?,?,?,?)
		",[
			$info['titre'],
			$info['description'], 
			$info['note'], 
			$info['id'],
			$info['user_id'],
		]);
	}
}
