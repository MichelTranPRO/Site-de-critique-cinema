<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_tvshow extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getTvshow(){

		//Pagination

		$data = $this->db->query("SELECT COUNT(id) AS nbSerie FROM tvshow");//Ici requête basique pour avoir le nb de Séries
 		$row = $data->row();//Ici je récupère la première ligne de $data
 		$nbSerie = (int)$row->nbSerie;//$row->nbSerie permet de récupérer la colone avec le résultat et (int) me permet de le convertir.

 		$parPages = 15;
 		$nbPages = ceil($nbSerie/$parPages);//Merci google voir la doc php.net
		 
 		if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<$nbPages){
 			$cPages = $_GET['p'];
 		}else{
 			$cPages = 1;
 		}

		$query = $this->db->query("
			SELECT tvshow.name,tvshow.id,jpeg,
					(SELECT COUNT(*) from season
					 WHERE season.tvShowId = tvshow.id) as nb
			FROM tvshow
			JOIN poster ON tvshow.posterId = poster.id
			LIMIT ".(($cPages-1)*$parPages).",$parPages"
		);
		for($i=1;$i<=$nbPages;$i++){
			echo "<a href=\"index.php?p=$i\" class='l'> $i </a>/";
		}
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
