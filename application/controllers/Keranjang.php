<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Keranjang extends CI_Controller
{
    public function viewId($rowid)
    {
        $row['barang'] = $this->cart->get_item($rowid);
        $this->load->model('Notif_model');
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $notif['cart'] = $this->cart->contents();
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
}
