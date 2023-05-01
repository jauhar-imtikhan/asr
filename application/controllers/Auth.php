<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');


        $user = $this->User_model->getbyid($email);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('valid_email', '{field} harus mengandung @gmail.com/Sejenisnya!');
        $this->form_validation->set_message('min_length', '{field} minimal 3 karekter');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('pages/auth/login');
        } else {

            if ($user) {
                if ($user['status'] == 1) {
                    if (password_verify($pass, $user['password'])) {
                        date_default_timezone_set('Asia/Jakarta');
                        $s = date('i');
                        $params = array(
                            'userid' => $user['user_id'],
                            'level' => $user['level'],
                            'jam' => $s
                        );
                        if ($user['level'] == '1') {
                            $this->session->set_userdata($params);
                            $this->session->set_flashdata('login', 'berhasil');
                            redirect('home');
                        } else if ($user['level'] == '2') {
                            $this->session->set_userdata($params);
                            $this->session->set_flashdata('login', 'berhasil');
                            redirect('toko');
                        }
                    } else {
                        $this->session->set_flashdata('msg', ' <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Maaf!</strong> Password Salah, Silahkan Coba Lagi
                    </div>');
                        $this->load->view('pages/auth/login');
                    }
                } else {
                    $this->session->set_flashdata('msg', ' <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Maaf!</strong> Akun Anda Belum Aktif, Silahkan Melakukan Aktivasi Akun Dahulu
                </div>');
                    $this->load->view('pages/auth/login');
                }
            } else {
                $this->session->set_flashdata('msg', ' <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Maaf!</strong> Silahkan Melakukan Pendaftaran Dahulu
            </div>');
                $this->load->view('pages/auth/login');
            }
        }
    }
}
