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

	public function is_user_exist($username){
		$query = $this->db->where('username',$username)->get('tbl_user')->row_array();
		if($query){
			return TRUE;
		}
		return FALSE;
	}

public function is_user_info_exist($username){
	$query = $this->db->where('username',$username)->get('tbl_user_info')->row_array();
	if($query){
		return TRUE;
	}
	return FALSE;
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

		$this->db->insert('tbl_user',$data);
		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}else{
			return 0;
		}
	}

	public function get_user_id($username){
		$this -> db -> select('user_id');
		$user_id = $this -> db -> get_where ('tbl_user',array('username'=>$username),0,1) -> row_array();
		return (int)$user_id['user_id'];
	}

	public function insert_user_info($username,$userid,$firstname,$lastname)
	{
		$data_info = array(
			'username' => $username,
			'first_name' => $firstname,
			'last_name' => $lastname,
			'user_id' => $userid,
		);
		$this->db->insert('tbl_user_info',$data_info);
		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}else{
			return 0;
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
	public function delete_user_info($username){
		return $this->db->delete('tbl_user_info', array('username' => $username));
	}
}
