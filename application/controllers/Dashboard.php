<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        check_not_login();
    }



    public function admin()
    {

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
        $this->load->model('barang');
        $this->load->library('pagination');

        // $row['databarang'] = $this->barang->getallbarang();
        $row['rating'] = $this->barang->rating();
        $config['base_url'] = base_url() . 'dashboard/toko';
        $config['total_rows'] = $this->barang->get_jml_barang();
        $config['per_page'] = 3;
        $config['full_tag_open']   = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
        $config['full_tag_close']  = '</ul>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = ' <i class="glyphicon glyphicon-menu-right"></i> ';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = ' <i class="glyphicon glyphicon-menu-left"></i> ';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $this->pagination->initialize($config);
        $from = $this->uri->segment(3);
        $row['databarang'] = $this->barang->data($config['per_page'], $from);

        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $notif['cart'] = $this->cart->contents();
        $notif['get_payment_notif'] = $this->Notif_model->getAllPaymentNotif($this->session->userdata('userid'));
        $notif['hitung_payment_notif'] = $this->Notif_model->hitungPaymentNotif($this->session->userdata('userid'));
        $data = [
            'title' => 'Dashboard toko',
            'content' => $this->load->view('pages/dashboard/dashboard_toko', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function getbarang()
    {
        $this->load->model('barang');
        $data['products'] = $this->barang->getallbarang();
        echo json_encode($data);
    }

    public function addkeranjang()
    {

        $id = $this->input->post('id');
        $nama = $this->input->post('nama_barang');
        $harga = $this->input->post('harga_barang');
        $deskripsi = $this->input->post('des_barang');
        $foto = $this->input->post('foto_barang');
        $berat = $this->input->post('berat');

        $data = array(
            'id'                  => $id,
            'qty'                 => 1,
            'price'               => $harga,
            'name'                => $nama,
            'description'         => $deskripsi,
            'foto'                => $foto,
            'berat'               => $berat
        );

        $this->cart->insert($data);
        redirect('dashboard/toko');
    }
}
