<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
    }



    public function admin()
    {
        check_not_login();
        $this->load->model('Notif_model');
        $this->load->library('encryption');
        $row['data'] = 'data';
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));

        $data = [
            'title' => 'Dashoard admin',
            'content' => $this->load->view('pages/dashboard/dashboard_admin', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function toko()
    {
        $this->load->model('Notif_model');
        $row['data'] = 'data';
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $data = [
            'title' => 'Dashboard toko',
            'content' => $this->load->view('pages/dashboard/dashboard_toko', '', TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }
}
