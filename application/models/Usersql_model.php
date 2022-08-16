<?php

class Usersql_model extends CI_Model {

	public $username;
	public $password;
	public $created_time;

	public function get_last_five_entries()
	{
		$this->load->database();
		$query = $this->db->get('tbl_user', 5);
		return $query->result();
	}

	public function insert_user()
	{
		$this->username    = $_POST['username'];
		$this->password  = $_POST['password'];
		$this->created_time = time();

		$this->db->insert('tbl_user', $this);
	}

	public function update_entry()
	{
		$this->username    = $_POST['username'];
		$this->password  = $_POST['password'];
		$this->created_time = time();

		$this->db->update('tbl_user', $this, array('user_id' => $_POST['user_id']));
	}
}
