<?php

class Login extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
		$this->load->model("user");
	}

	public function view_user(){
		$this->user->get_entries();
	}

	public function signup_user(){
		//todo:插入前判断用户是否存在

		$insert_user_id = $this->user->insert_user('kakukaku', 'nasanasa');
		if($insert_user_id === 0){

		}else{
			//user_info 插入 user_id username firstname=1 ln =2
			//todo 判断插入是否成功 失败回滚数据库（开启事务）
		}
		//user_id
	$this->_handle_response('ok','insert success',['user_id'=>100]);
	}

	public function login_hp(){
		$this->load->view('login.php');
	}

	public function login_input_data(){
		$username = $this->validateEmail($_POST['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name un legal');
			return ;
		}
		if(!isset($_POST['password'])){
			$this->_handle_response('failed','password un legal');
			return ;
		}
		$data = $this->user->search_user($username);
		if ($data == NULL)
		{
			$this->_handle_response( 'failed','user not exist');
			return;
		}
		if($data['password']!=$_POST['password'])
		{
			$this->_handle_response( 'failed','password wrong');
			return;
		}
		$user_info = $this->user->search_user_info($data['username']);
		$this->_handle_response( 'ok','login success',$user_info);


	}

	public function change_password()
	{

		$username = $this->validateEmail($_POST['username']??'');
		if(!$username){
			$this->_handle_response('failed','user name un legal');
			return ;
		}

		if(!isset($_POST['old_password']) || !isset($_POST['new_password'])){
			$this->_handle_response('failed','password un legal');
			return ;
		}

		$data = $this->user->search_user($username);

		if ($data == NULL)
		{
			$this->_handle_response( 'failed','user not exist');
			return;
		}

		if ($data['password'] !== $_POST['old_password']){
			$this->_handle_response( 'failed','password wrong');
			return;
		}

		$remsg = $this->user->update_password($username,$_POST['new_password']);
		if(!$remsg){
			$this->_handle_response( 'failed','changed failed');
			return;
		}

		$this->_handle_response( 'ok','password changed');

	}

	public function delete_user()
	{
		$username = $this->validateEmail($_POST['username']??'');
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

		$remsg = $this->user->delete_user($username);
		if(!$remsg){
			$this->_handle_response( 'failed','delete user failed');
			return;
		}
		$this->_handle_response( 'ok','delete user success');


	}

	public function search_user_info()
	{
		$username = $this->validateEmail($_POST['username']??'');
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
