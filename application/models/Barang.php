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

    public function rating()
    {
        $this->db->select('rating');
        $this->db->from('databarang');
        return $this->db->get()->result_array();
    }

    public function get_jml_barang()
    {
        return  $this->db->get('databarang')->num_rows();
    }

    public function data($number, $offset)
    {
        return  $this->db->get('databarang', $number, $offset)->result_array();
    }
}
