<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function getUser(){
		$query = $this->db->query("
			SELECT
			a.`user_id`,
			a.`user_photo_name`,
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
	
	public function getDetailUser($id){
		$query = $this->db->query("
			SELECT
			a.`user_id`,
			a.`user_photo_name`,
			a.`user_full_name`,
			a.`user_username`,
			a.`user_email`,
			a.`user_level_id`,
			a.`user_desc`,
			b.`level_name`

		FROM `user` a
		LEFT JOIN user_ref_level b ON a.`user_level_id` = b.`level_id`
		WHERE a.`user_id`= $id
		");
		$result = $query->row();
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
	public function updateUser($param, $user_id){
		$query = $this->db->update('user', $param, array('user_id'=>$user_id));		
		return $query;
		
	}
    public function deleteInv($id){
		$query = $this->db->delete('user', array('user_id' => $id));
		return $query;
	}

}