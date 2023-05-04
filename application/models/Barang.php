<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Barang extends CI_Model
{
    public function getallbarang()
    {
        $this->db->select('*');
        $this->db->from('databarang');
        $this->db->join('kategori', 'kategori.id_kategori=databarang.kategori');
        return $this->db->get()->result_array();
    }
}
