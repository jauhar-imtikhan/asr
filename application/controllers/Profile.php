<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function user()
    {
        if ($this->session->userdata('method') == 'db') {
            $this->load->model('Notif_model');
            $row['data'] = $this->db->get_where('user', ['user_id' => $this->session->userdata('userid')])->row_array();
            $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
            $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
            $data = [
                'title' => 'User Profile',
                'content' => $this->load->view('pages/profile/user_profile', $row, TRUE),
                'sidebar' => $this->load->view('components/sidebar', '', TRUE),
                'footer' => $this->load->view('components/footer', '', TRUE),
                'navbar' => $this->load->view('components/navbar', $notif, TRUE),
                'custom' => $this->load->view('components/settingpage', '', TRUE),
            ];
            $this->parser->parse('template', $data);
        } else if ($this->session->userdata('method') == 'google') {
            $row['error'] = '<div class="alert alert-danger">
            
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong><i class="fa fa-ban"></i> Maaf!</strong> Di karenakan Anda Login Menggunakan Google, Maka Anda Tidak Dapat Mengubah Profile Anda!
</div>';
            $row['alamat'] = 'Belum Punya Alamat';
            $row['level'] = $this->db->get('level')->result_array();
            $data = [
                'title' => 'User Profile',
                'content' => $this->load->view('pages/profile/user_profile', $row, TRUE),
                'sidebar' => $this->load->view('components/sidebar', '', TRUE),
                'footer' => $this->load->view('components/footer', '', TRUE),
                'navbar' => $this->load->view('components/navbar', '', TRUE),
                'custom' => $this->load->view('components/settingpage', '', TRUE),
            ];
            $this->parser->parse('template', $data);
        }
    }

    public function update($id)
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $level = $this->input->post('level');
        $alamat = $this->input->post('alamat');
        $nowa = $this->input->post('nowa');
        $resultNama = explode(' ', $nama);

        $data = [
            'nama_depan' => $resultNama[0],
            'nama_belakang' => $resultNama[1],
            'email' => $email,
            'alamat' => $alamat,
            'level' => $level,
            'nowa' => $nowa
        ];
        $this->load->model('user_model');
        $this->user_model->updateProfile($id, $data);

        $notifications = [
            'id_notification' => $id,
            'isi_notif' => 'Anda Berhasil Update Data User',
            'icon_notif' => 'fa fa-user text-green',
            'redirect' => $this->uri->segment()
        ];
        $this->db->insert('all_notification', $notifications);

        redirect('profile/user');
    }
}
