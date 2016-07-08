<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function getUser(){
		$query = $this->db->query("
			SELECT
			a.`user_id`,
			a.`user_full_name`,
			a.`user_username`,
			a.`user_email`,
			a.`user_level_id`,
			b.`level_name`

		FROM `user` a
		JOIN user_ref_level b ON a.`user_level_id` = b.`level_id`
		");
		$result = $query->result();
		return $result;
	}
	
	public function getUserLevel(){
		$query = $this->db->get('user_ref_level');
		return $query->result();
	}
	
	public function insertUser($param){
		$query = $this->db->insert('user', $param);
		return $query;		
	}
    

}