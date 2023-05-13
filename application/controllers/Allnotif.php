<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Allnotif extends CI_Controller
{
    public function delbyid($id)
    {
        $this->load->model('Notif_model');
        $this->Notif_model->deleteById($id);
        $data = [
            'id_notification' => $this->session->userdata('userid'),
            'isi_notif' =>  'Notifikasi Terhapus!',
            'icon_notif' => 'fa fa-user text-red'
        ];
        $this->db->insert('all_notification', $data);
        $url = $this->input->server('HTTP_REFERER');
        redirect($url);
    }

    public function deleteall($id)
    {
        $this->load->model('Notif_model');
        $this->Notif_model->deleteAllById($id);
        $url = $this->input->server('HTTP_REFERER');
        redirect($url);
    }

    public function delpaymetall($id)
    {
        $this->load->model('Notif_model');
        $this->Notif_model->deletePaymentById($id);
        $url = $this->input->server('HTTP_REFERER');
        redirect($url);
    }
}
