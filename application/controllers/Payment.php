<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment extends CI_Controller
{
    public function tunai($id)
    {
        $row['datainvoice'] = $this->db->get_where('payment_submit', ['id_payment' => $id])->row_array();
        $this->load->model('Notif_model');
        $notif['all_notif'] = $this->Notif_model->CountAllNotifById($this->session->userdata('userid'));
        $notif['getnotif'] = $this->Notif_model->get_all_notif($this->session->userdata('userid'));
        $notif['cart'] = $this->cart->contents();
        $notif['get_payment_notif'] = $this->Notif_model->getAllPaymentNotif($this->session->userdata('userid'));
        $notif['hitung_payment_notif'] = $this->Notif_model->hitungPaymentNotif($this->session->userdata('userid'));
        $data = [
            'title' => 'Verifikasi Pembayaran',
            'content' => $this->load->view('extras/invoice_tunai_customer', $row, TRUE),
            'sidebar' => $this->load->view('components/sidebar', '', TRUE),
            'footer' => $this->load->view('components/footer', '', TRUE),
            'navbar' => $this->load->view('components/navbar', $notif, TRUE),
            'custom' => $this->load->view('components/settingpage', '', TRUE),
        ];
        $this->parser->parse('template', $data);
    }
}
