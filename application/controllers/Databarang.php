<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Databarang extends CI_Controller
{
    public function index()
    {
        $this->load->model('Notif_model');
        $this->load->model('barang');
        $row['data'] = $this->barang->getallbarang();
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $data = [
            'title' => 'Data Barang',
            'content' => $this->load->view('pages/databarang', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function getdetail()
    {
        $id =  $this->input->get('id');
        $this->db->select('*');
        $this->db->from('databarang');
        $this->db->join('kategori', 'kategori.id_kategori=databarang.kategori');
        $this->db->where('id_barang', $id);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
    }
    public function editBarang()
    {
        $this->load->view('pages/modal/editbarang');
    }

    public function updatedatabarang($id)
    {
        $this->load->library('upload');

        // Mengambil data dari form
        $name = $this->input->post('nama');
        $harga = preg_replace('/[^0-9]/', '', $this->input->post('harga'));
        $kategori = $this->input->post('kategori');
        $deskripsi = $this->input->post('deskripsi');

        // Upload file gambar ke server
        $config['upload_path'] = base_url() . 'uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('photo')) {
            // Jika upload gagal, tampilkan pesan error
            $val = [
                'nama_barang' => $name,
                'harga_barang' => $harga,
                'kategori' => $kategori,
                'deskripsi' => $deskripsi
            ];
            $this->db->where('id_barang', $id);
            $this->db->update('databarang', $val);
            $data = [
                'id_notification' => $this->session->userdata('userid'),
                'isi_notif' => 'Berhasil Update Foto Profile!',
                'icon_notif' => 'fa fa-user text-red'
            ];
            $this->db->insert('all_notification', $data);
            redirect('databarang');
        } else {
            // Jika upload berhasil, simpan data ke database
            $val = [
                'nama_barang' => $name,
                'harga_barang' => $harga,
                'kategori' => $kategori,
                'foto' => $this->upload->data('file_name')
            ];
            $this->db->where('id_barang', $id);
            $this->db->update('databarang', $val);
            $data = [
                'id_notification' => $this->session->userdata('userid'),
                'isi_notif' => 'Berhasil Update Data Barang',
                'icon_notif' => 'fa fa-user text-green'
            ];
            $this->db->insert('all_notification', $data);
            redirect('databarang');
        }
    }
}
