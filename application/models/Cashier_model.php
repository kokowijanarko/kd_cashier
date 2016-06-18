<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cashier_model extends CI_Model
{
	
    // public function __construct()
    // {
        // parent::__construct();
        // $this->load->database();
        // $this->load->library('session');
    // }
	
	public function getInventory(){		
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
			ORDER BY inv_name
			
		');
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
	
	public function getLastOrderCode(){
		$query = $this->db->query('SELECT MAX(order_code) AS order_code FROM cash_order');
		$order_code = $query->row();
		return $order_code->order_code;
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
	
	public function insertOrder($param){
		$query = $this->db->insert('cash_order', $param);
		return $query;
	}
	
	public function insertOrderDetail($param){
		$query = $this->db->insert_batch('cash_order_detail', $param);		
		return $query;
	}
	
	public function getInvDetailByInvNumber($inv_number){
		$query = $this->db->query("
			SELECT * FROM cash_order WHERE order_id='$inv_number'
		");
		return $query->row();
	}
	public function getInvDetail($id){
		$query = $this->db->query("
			SELECT 
				a.`orderdetail_id`,
				b.`inv_name`,
				b.`inv_id`,
				b.`inv_price`,
				c.`type_name`,
				d.`category_name`
				
			FROM cash_order_detail a 
			JOIN inv_inventory b ON a.`orderdetail_product_id` = b.`inv_id`
			JOIN inv_ref_inventory_type c ON c.`type_id` = b.`inv_type_id`
			JOIN inv_ref_inventory_category d ON d.`category_id` = b.`inv_category_id`
			WHERE a.`orderdetail_order_id` = '$id'
		");
		return $query->result();
	}
	


}