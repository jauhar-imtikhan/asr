<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function user()
    {
        check_not_login();
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
            $this->load->model('Notif_model');
            $row['alamat'] = 'Belum Punya Alamat';
            $row['level'] = $this->db->get('level')->result_array();
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
        ];
        $this->db->insert('all_notification', $notifications);

        redirect('profile/user');
    }

    public function changepicture($id)
    {

        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];


            move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);


            $foto = [
                'foto_user' => $file['name']
            ];
            $this->load->model('user_model');
            $file_foto = $this->user_model->rowId($id);
            if ($file_foto['foto_user'] != 'default.jpg') {
                unlink('uploads/' . $file_foto['foto_user']);
            }
            $this->db->where('user_id', $id);
            $this->db->update('user', $foto);

            $data = [
                'id_notification' => $id,
                'isi_notifikasi' => 'Berhasil Update Foto Profile!',
                'icon_notif' => 'fa fa-user text-red'
            ];

            $this->db->insert('all_notification', $data);
            echo json_encode('baja');
        }
    }
    public function update_photo($id)
    {
        $config['upload_path'] = FCPATH . 'uploads/';
        $config['allowed_types'] = 'svg|jpg|jpeg|png';
        $config['encrypt_name'] = FALSE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            $oldFileName = $this->db->select('*')->get_where('user', ['user_id' => $id])->row()->foto_user;

            if (!empty($oldFileName) == 'default.jpg') {
                unlink('uploads/' . $oldFileName);
            }

            $data = ['foto_user' => $this->upload->data('file_name')];
            $this->db->where('user_id', $id)->update('user', $data);
            $data = [
                'id_notification' => $id,
                'isi_notif' => 'Berhasil Update Foto Profile!',
                'icon_notif' => 'fa fa-user text-red'
            ];

            $this->db->insert('all_notification', $data);
            echo 'user';
        } else {
            echo 'user';
        }
    }
}
