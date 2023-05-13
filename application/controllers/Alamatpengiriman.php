<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Alamatpengiriman extends CI_Controller
{
    public function index()
    {

        $this->load->model('Notif_model');
        $this->load->model('Alamat_model');
        $row['addr'] = $this->Alamat_model->getAlamat($this->session->userdata('userid'));
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $notif['cart'] = $this->cart->contents();
        $notif['get_payment_notif'] = $this->Notif_model->getAllPaymentNotif($this->session->userdata('userid'));
        $notif['hitung_payment_notif'] = $this->Notif_model->hitungPaymentNotif($this->session->userdata('userid'));
        $data = [
            'title' => 'Alamat Pengiriman',
            'content' => $this->load->view('extras/alamatpengiriman', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function add()
    {
        $nama = $this->input->post('namapenerima');
        $nowa = $this->input->post('nowa');
        $alamat = $this->input->post('detailalamat');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kecamatan');

        $data = [
            'id_user' => $this->session->userdata('userid'),
            'alamat' => $alamat,
            'nowa' => $nowa,
            'atas_nama' => $nama,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan
        ];
        $this->db->insert('alamat_pengiriman', $data);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' => 'Berhasil Menambahkan Alamat!',
            'icon_notif' => 'fa fa-user text-green'
        ];
        $this->db->insert('all_notification', $data);
        redirect('alamatpengiriman');
    }

    public function update($id)
    {
        $nama = $this->input->post('namapenerima');
        $nowa = $this->input->post('nowa');
        $alamat = $this->input->post('detailalamat');
        $provinsi = $this->input->post('provinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kecamatan');

        $data = [
            'id_user' => $id,
            'alamat' => $alamat,
            'nowa' => $nowa,
            'atas_nama' => $nama,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan
        ];
        $this->db->where('id_user', $id);
        $this->db->update('alamat_pengiriman', $data);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' => 'Berhasil Menambahkan Alamat!',
            'icon_notif' => 'fa fa-user text-green'
        ];
        $this->db->insert('all_notification', $data);
        redirect('alamatpengiriman');
    }
}
