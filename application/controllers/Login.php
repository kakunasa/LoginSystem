<?php

class Login extends CI_Controller {

	public $post_data;

	public function  __construct()
	{
		parent::__construct();
		$this->load->model("user");
		$this->load->database();

		$data_raw = $this->security->xss_clean($this->input->raw_input_stream);
		$data =explode('&', $data_raw);
		//todo
		foreach ($data_raw as $str){
			explode('&', $data_raw);
		}
		if(isset($data_raw) && $data_raw){
			var_dump($data_raw);
			$this->post_data = json_decode($data_raw, true);

		}

	}

	public function view_user(){
		$this->user->get_entries();
	}

	public function signup_user(){
		$data=$this->post_data;

		var_dump($data);
		return;
		if((!isset($data['password']))&&(!isset($data['firstname']))&&(!isset($data['lastname']))&&(!isset($data['username']))){
			$this->_handle_response('failed','not fill all inputs');
			return ;
		}
		$username = $this->validateEmail($data['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name should be email');
			return ;
		}
		$is_user_exist=$this->user->is_user_exist($username);
		if($is_user_exist){
			$this->_handle_response('failed','user has already exist');
			return;
		}

		$this->db->trans_start();
		$insert_user_id = $this->user->insert_user($username, $this->post_data['password']);
		if($insert_user_id === 0){
			$this->db->trans_rollback();
			$this->_handle_response('failed','insert failed');
			return;
		}
//		$is_user_info_exist=$this->user->is_user_info_exist($username);
//		if($is_user_info_exist){
//			$this->_handle_response('failed','user info has already exist');
//			return;
//		}
		$insert_user_info = $this->user->insert_user_info($username, $insert_user_id,$this->post_data['firstname'],$this->post_data['lastname']);
		if($insert_user_info === 0){
			$this->db->trans_rollback();
			$this->_handle_response('failed','insert info failed');
			return;
		}
		if($this->db->trans_complete()){
			$this->_handle_response('ok','insert success');
		}else{
			$this->_handle_response('failed','commit failed');
		};
	}

	public function login_hp(){
		$this->load->view('login.php');
	}

	public function login_input_data(){
		$username = $this->validateEmail($this->post_data['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name un legal');
			return ;
		}
		if(!isset($this->post_data['password'])){
			$this->_handle_response('failed','password un legal');
			return ;
		}
		$data = $this->user->search_user($username);
		if ($data == NULL)
		{
			$this->_handle_response( 'failed','user not exist');
			return;
		}
		if($data['password']!=$this->post_data['password'])
		{
			$this->_handle_response( 'failed','password wrong');
			return;
		}
		$user_info = $this->user->search_user_info($data['username']);
		$this->_handle_response( 'ok','login success',$user_info);


	}

	public function change_password()
	{

		$username = $this->validateEmail($this->post_data['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name un legal');
			return ;
		}

		if(!isset($this->post_data['old_password']) || !isset($this->post_data['new_password'])){
			$this->_handle_response('failed','password un legal');
			return ;
		}

		$data = $this->user->search_user($username);

		if ($data == NULL)
		{
			$this->_handle_response( 'failed','user not exist');
			return;
		}

		if ($data['password'] !== $this->post_data['old_password']){
			$this->_handle_response( 'failed','password wrong');
			return;
		}

		$remsg = $this->user->update_password($username,$this->post_data['new_password']);
		if(!$remsg){
			$this->_handle_response( 'failed','changed failed');
			return;
		}

		$this->_handle_response( 'ok','password changed');

	}

	public function delete_user()
	{
		$username = $this->validateEmail($this->post_data['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name un legal');
			return ;
		}
		$data = $this->user->search_user($username);
		if ($data == NULL)
		{
			$this->_handle_response( 'failed','user not existent');
			return;
		}

		$this->db->trans_start();
		$del_user = $this->user->delete_user($username);
		if((!$del_user)){
			$this->_handle_response( 'failed','delete user failed');
			return;
		}
		$del_user_info = $this->user->delete_user_info($username);
//		$del_user_info=TRUE;

		if(!$del_user_info){
			$this->db->trans_rollback();
			$this->_handle_response( 'failed','delete user failed');
			return;
		}

		if($this->db->trans_complete()){
			$this->_handle_response( 'ok','delete user success');
		}else{
			$this->_handle_response( 'failed','commit failed');
		}

	}

	public function search_user_info()
	{
		$username = $this->validateEmail($this->post_data['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name un legal');
			return ;
		}

		$data = $this->user->search_user_info($username);
		if ($data == NULL)
		{
			$this->_handle_response('failed','user info not existent');
			return;
		}
		$this->_handle_response('ok','search user info success',['user_info'=>$data]);

	}

	private function _handle_response($result,$status,$data=[]){
		$response['result'] = $result;
		$response['status'] = $status;
		$response['data']=$data;

		echo json_encode($response);
	}

	public function validateEmail($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}



}
