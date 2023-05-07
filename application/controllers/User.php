<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        check_not_login();
        $this->load->model('User_model');
        $row['data'] = $this->User_model->get();
        $this->load->model('Notif_model');
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $data = [
            'title' => 'Halaman User',
            'content' => $this->load->view('pages/user', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function edituser()
    {
        $this->load->view('pages/modal/edituser');
    }

    public function proedituser($id)
    {
        $nama_depan = $this->input->post('namdep');
        $nama_belakang = $this->input->post('nambel');
        $alamat = $this->input->post('alamat');
        $level = $this->input->post('level');
        $no = $this->input->post('nowa');
        $email = $this->input->post('email');

        $val = [
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'email' => $email,
            'alamat' => $alamat,
            'level' => $level,
            'nowa' => $no
        ];
        $this->db->where('user_id', $id);
        $this->db->update('user', $val);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' => 'Berhasil Update Data User!',
            'icon_notif' => 'fa fa-user text-green'
        ];
        $this->db->insert('all_notification', $data);
        redirect('user');
    }

    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }

    public function adduser()
    {
        $this->load->view('pages/modal/adduser');
    }

    public function proadduser()
    {
        $nama_depan = $this->input->post('namadepan');
        $nama_belakang = $this->input->post('namabelakang');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        $no = $this->input->post('nowa');
        $status = $this->input->post('status');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $alamat = $provinsi . ',' . $kabupaten . ',' . $kecamatan . ',' . $kelurahan;

        $data = [
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => $level,
            'status' => $status,
            'alamat' => $alamat,
            'nowa' => $no
        ];
        $this->db->insert('user', $data);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' => 'Berhasil Menambahkan Data User!',
            'icon_notif' => 'fa fa-user text-green'
        ];
        $this->db->insert('all_notification', $data);
        redirect('user');
    }
}
