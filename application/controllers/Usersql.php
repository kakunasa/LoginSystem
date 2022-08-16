<?php

class Usersql extends CI_Controller {

	public function view_user(){
		$this->load->model('Usersql_model');
		$data['query'] = $this->Usersql_model->get_last_five_entries();
		$this->load->view('usersql.html', $data);
	}

	public function insurt(){
		$this->load->view("user_sql.html");
	}
}
