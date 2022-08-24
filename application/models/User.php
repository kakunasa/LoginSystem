<?php

class User extends CI_Model {

	public $username;
	public $password;
	public $created_time;

	public function  __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_entries()
	{
		$query = $this->db->get('tbl_user');
		return $query->result_array();
	}

	public function search_user($username){
		return $this->db->where('username',$username)->get('tbl_user')->row_array();
	}

	public function search_user_info($username){
		return $this->db->where('username',$username)->get('tbl_user_info')->row_array();
	}

	public function insert_user($username,$password)
	{
		$data = array(
			'username' => $username,
			'password'  => $password,
		);
		$is_success = $this->db->insert('tbl_user',$data);
		if ($is_success){
			return $this->db->insert_id();
		}
		return 0;
	}

	public function insert_user_info($user_info_id)
	{
		$data = array(
			'user_id' => $username,
			'password'  => $password,
		);
		$is_success = $this->db->insert('tbl_user',$data);
		if ($is_success){
			return $this->db->insert_id();
		}else{
			return 'insert failed';
		}
	}

	public function update_password($username,$new_password)
	{
		$data = array(
			'username' => $username,
			'password'  => $new_password,
		);
		$this->db->where('username',$username);
		return $this->db->update('tbl_user', $data);
	}

	public function delete_user($username){
		return $this->db->delete('tbl_user', array('username' => $username));
	}
}
