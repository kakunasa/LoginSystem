<?php


class Blog extends CI_Controller {
	public function index()
	{
		echo('111');
		$this->load->view('blog.html');
	}
}
