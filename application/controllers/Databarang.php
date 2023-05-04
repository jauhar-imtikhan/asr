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
        if (isset($_POST['save'])) {

            $config['upload_path']          = FCPATH . '/uploads';
            $config['allowed_types']        = 'svg|jpg|png|jpeg';
            $config['max_size']             = 2048;
            $config['max_width']            = 2366;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo')) {

                $nama = $this->input->post('nama');
                $harga = preg_replace('/[^0-9]/', '', $this->input->post('harga'));
                $kategori = $this->input->post('kategori');
                $deskripsi = $this->input->post('deskripsi');


                $val = array(
                    'nama_barang' => $nama,
                    'harga_barang' => $harga,
                    'kategori' => $kategori,
                    'deskripsi' => $deskripsi,
                );
                $this->db->where('id_barang', $id);
                $this->db->update('databarang', $val);
                $data = [
                    'id_notification' => $this->session->userdata('userid'),
                    'isi_notif' => 'Berhasil Update Data Barang!',
                    'icon_notif' => 'fa fa-user text-blue'
                ];
                $this->db->insert('all_notification', $data);
                redirect('databarang');
            } else {
                $nama = $this->input->post('nama');
                $harga = preg_replace('/[^0-9]/', '', $this->input->post('harga'));
                $kategori = $this->input->post('kategori');
                $deskripsi = $this->input->post('deskripsi');

                $val = array(
                    'nama_barang' => $nama,
                    'harga_barang' => $harga,
                    'kategori' => $kategori,
                    'deskripsi' => $deskripsi,
                    'foto' => $this->upload->data('file_name')
                );

                $cek_foto = $this->db->get('databarang')->result();
                foreach ($cek_foto as $d) {
                    unlink("uploads/" . $d->foto_bg);
                }
                $this->db->where('id_barang', $id);
                $this->db->update('databarang', $val);
                $data = [
                    'id_notification' => $this->session->userdata('userid'),
                    'isi_notif' => 'Berhasil Update Data Barang!',
                    'icon_notif' => 'fa fa-user text-blue'
                ];
                $this->db->insert('all_notification', $data);
                redirect('databarang');
            }
        }
    }
}
