<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
    }

    public function viewId($rowid)
    {
        $row['barang'] = $this->cart->get_item($rowid);
        $this->load->model('Notif_model');
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $notif['cart'] = $this->cart->contents();
        $notif['get_payment_notif'] = $this->Notif_model->getAllPaymentNotif($this->session->userdata('userid'));
        $notif['hitung_payment_notif'] = $this->Notif_model->hitungPaymentNotif($this->session->userdata('userid'));
        $data = [
            'title' => 'Detail Barang',
            'content' => $this->load->view('pages/keranjang/v_all', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function checkout()
    {
        $this->load->model('Notif_model');
        $row['databarang'] = $this->cart->contents();
        $row['payment'] = $this->db->get('metode_pembayaran')->result_array();
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $notif['cart'] = $this->cart->contents();
        $notif['get_payment_notif'] = $this->Notif_model->getAllPaymentNotif($this->session->userdata('userid'));
        $notif['hitung_payment_notif'] = $this->Notif_model->hitungPaymentNotif($this->session->userdata('userid'));
        $data = [
            'title' => 'Check Out',
            'content' => $this->load->view('pages/keranjang/v_checkout', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }

    public function updatecheckout($id)
    {
        if (isset($_POST['add'])) {
            $data = array(
                'rowid' => $id,
                'qty' => $this->input->post('qty')
            );
            $this->cart->update($data);
            $dk = $this->cart->get_item($id);
            $dknama = ucfirst($dk['name']);
            $data = [
                'id_notification' => $this->session->userdata('userid'),
                'isi_notif' => "Berhasil Tambah Jumlah Barang <b>$dknama</b>!",
                'icon_notif' => 'fa fa-user text-green'
            ];
            $this->db->insert('all_notification', $data);
            redirect('keranjang/checkout');
        } else if (isset($_POST['min'])) {
            $data = array(
                'rowid' => $id,
                'qty' => $this->input->post('qty')
            );
            $this->cart->update($data);
            $dk = $this->cart->get_item($id);
            $dknama = ucfirst($dk['name']);
            $data = [
                'id_notification' => $this->session->userdata('userid'),
                'isi_notif' => "Berhasil Mengurangi Jumlah Barang <b>$dknama</b>!",
                'icon_notif' => 'fa fa-user text-green'
            ];
            $this->db->insert('all_notification', $data);
            redirect('keranjang/checkout');
        }
    }

    public function hapus($id)
    {
        $this->cart->remove($id);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' => 'Berhasil Menghapus Barang!',
            'icon_notif' => 'fa fa-user text-green'
        ];
        $this->db->insert('all_notification', $data);
        redirect('keranjang/checkout');
    }

    public function tunai()
    {
        $data['rowid'] = $this->input->get('rowid');
        $this->load->view('pages/modal/payment_tunai', $data);
    }

    public function getprovinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 556763a54c03883f6e1a828589c78b3a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($response);
        }
    }

    public function getongkir()
    {
        $origin = $this->input->get('origin');
        $destination = $this->input->get('destination');
        $weight = $this->input->get('weight');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 556763a54c03883f6e1a828589c78b3a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($response);
        }
    }

    public function submit_payment()
    {
        $nama_pengirim  = $this->input->post('nama_pengirim');
        $nama_penerima = $this->input->post('nama_penerima');
        $barang = $this->input->post('barang');
        $paymet = $this->input->post('payment');
        $ekspedisi = $this->input->post('ekspedisi');
        $layanan = $this->input->post('layanan');
        $subtotal = $this->input->post('subtotal');
        $dp = $this->input->post('dp');
        $ongkir = $this->input->post('ongkir');
        $estimasi = $this->input->post('estimasi');
        $total = $this->input->post('total');
        $date_created = $this->input->post('date_created');
        $date = str_replace("Tanggal : ", "", $date_created);
        $val[] = [
            'id_payment' => $this->session->userdata('userid'),
            'nama_pengirim' => $nama_pengirim,
            'nama_penerima' => $nama_penerima,
            'barang' => $barang,
            'payment' => $paymet,
            'ekspedisi' => $ekspedisi,
            'layanan' => $layanan,
            'subtotal' => $subtotal,
            'dp' => $dp,
            'ongkir' => $ongkir,
            'estimasi' => $estimasi,
            'total' => $total,
            'date_created' => $date
        ];

        $this->db->insert_batch('payment_submit', $val);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' => 'Berhasil Submit Pembayaran!',
            'icon_notif' => 'fa fa-user text-green'
        ];
        $this->db->insert('all_notification', $data);
        $payment = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notification' => 'Check Out Berhasil!',
            'icon_notification' => 'fa fa-user text-green',
            'id_payment_notif' => $this->session->userdata('userid')
        ];
        $this->db->insert('payment_notification', $payment);
        $this->cart->destroy();
        redirect('dashboard/toko');
    }
}
