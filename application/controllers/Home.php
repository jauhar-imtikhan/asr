<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		check_not_login();
		$this->load->model('Notif_model');
		$notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
		$notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
		$data = [
			'title' => 'Dashboard',
			'content' => $this->load->view('pages/dashboard', '', TRUE),
			'sidebar' => $this->load->view('components/sidebar', '', TRUE),
			'footer' => $this->load->view('components/footer', '', TRUE),
			'navbar' => $this->load->view('components/navbar', $notif, TRUE),
			'custom' => $this->load->view('components/settingpage', '', TRUE),
		];
		$this->parser->parse('template', $data);
	}
}
