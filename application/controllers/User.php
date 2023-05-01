<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $this->load->model('User_model');
        $row['data'] = $this->User_model->get();
        $data = [
            'title' => 'User Page',
            'content' => $this->load->view('pages/user', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', '', TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }
}
