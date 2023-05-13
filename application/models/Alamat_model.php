<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Alamat_model extends CI_Model
{
    public function getAlamat($id)
    {
        $this->db->select('*');
        $this->db->from('alamat_pengiriman');
        $this->db->where('id_user', $id);
        return $this->db->get()->row_array();
    }
}
