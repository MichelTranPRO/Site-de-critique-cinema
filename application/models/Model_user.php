<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_user extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function setInfo($info){
		$query = $this->db->query("
		INSERT INTO user (email,mot_de_passe,nom,prenom)
		VALUES (?,?,?,?)
		",[
			$info['email'],
			$info['mdp'], 
			$info['nom'], 
			$info['prenom']
		]);
	} 
	public function getEmail($email){
		$query = $this->db->query("
		SELECT email 
		FROM user 
		WHERE email= ?
		",[$email]);
		return $query->row();
	} 	
	public function getMDP($email){
		$query = $this->db->query("
		SELECT mot_de_passe 
		FROM user 
		WHERE email= ?
		",[$email]);
		return $query->row();
	} 	
	public function getPrenomNom($email){
		$query = $this->db->query("
		SELECT prenom,nom 
		FROM user 
		WHERE email= ?
		",[$email]);
		return $query->row();
	}
}
