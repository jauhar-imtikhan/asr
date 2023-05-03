<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif_model extends CI_Model
{
    public function CountAllNotifById($id)
    {
        $this->db->select("COUNT(*) as jumlah");
        $this->db->where('id_notification', $id);
        $result = $this->db->get('all_notification')->row();
        return  $result->jumlah;
    }

    public function get_all_notif($id)
    {
        $this->db->select('*');
        $this->db->where('id_notification', $id);
        $this->db->from('all_notification');
        return $this->db->get()->result();
    }

    public function deleteById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('all_notification');
    }

    public function deleteAllById($id)
    {
        $this->db->where('id_notification', $id);
        $this->db->delete('all_notification');
    }
}
