<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		check_not_login();
		$data = [
			'title' => 'Dashboard',
			'content' => $this->load->view('pages/dashboard', '', TRUE),
			'sidebar' => $this->load->view('components/sidebar', '', TRUE),
			'footer' => $this->load->view('components/footer', '', TRUE),
			'navbar' => $this->load->view('components/navbar', '', TRUE),
			'custom' => $this->load->view('components/settingpage', '', TRUE),
		];
		$this->parser->parse('template', $data);
	}
}
