<?php
class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('user_model');
        $userid = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_model->user_login($userid)->row();
        return $user_data;
    }
}
