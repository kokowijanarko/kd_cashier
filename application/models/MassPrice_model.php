<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class MassPrice_model extends CI_Model
{
	
    // public function __construct()
    // {
        // parent::__construct();
        // $this->load->database();
        // $this->load->library('session');
    // }
	
	public function getMassPrice($id){		
		$query = $this->db->query("
			SELECT 
				b.`inv_id`,
				b.`inv_name`,
				(SELECT MIN(massprice_range_start) 
				  FROM inv_mass_price
				  WHERE massprice_inv_id = a.`massprice_inv_id`)
				AS massprice_lowest_range_start,
				a.`massprice_range_start`,
				a.`massprice_range_end`,
				a.`massprice_price`,
				a.`massprice_id`				
			FROM inv_mass_price a
			LEFT JOIN inv_inventory b ON b.`inv_id` = a.`massprice_inv_id`
			WHERE a.`massprice_inv_id` = $id
			
		");
		$result = $query->result();
		return $result;
	}
	
	public function getMassPriceById($id){		
		$query = $this->db->query("
			select * from inv_mass_price where massprice_id = $id			
		");
		$result = $query->result();
		return $result;
	}
	
	public function getInvDetailById($id){		
		$query = $this->db->query('
			SELECT
				a.inv_id,
				a.inv_name,
				a.inv_category_id,
				a.inv_type_id,
				a.inv_desc,
				a.inv_price,
				a.inv_stock,
				b.type_name,
				c.category_name
			FROM inv_inventory a 
			LEFT JOIN inv_ref_inventory_category c ON c.category_id = a.inv_category_id 
			LEFT JOIN inv_ref_inventory_type b ON b.type_id = a.inv_type_id
			WHERE a.inv_id = "'.$id.'"
			
		');
		$result = $query->row();
		return $result;
	}
	public function getInventoryType(){
		$query = $this->db->get('inv_ref_inventory_type');
		$result = $query->result();
		return $result;
	}
	public function getInventoryCategory(){
		$query = $this->db->get('inv_ref_inventory_category');
		$result = $query->result();
		return $result;
	}
	
	public function insertInventory($param){
		$query = $this->db->insert('inv_inventory', $param);
		
		return $query;
		
	}
	public function UpdateInventory($param_inv, $id){
		//$query = $this->db->where('inv_id', $id);
		$query = $this->db->update('inv_inventory', $param_inv, array('inv_id'=>$id));		
		return $query;
		
	}
	
	public function deleteInv($id){
		$query = $this->db->delete('inv_inventory', array('inv_id' => $id));
		return $query;
	}
	


}