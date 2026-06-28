<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        $this->db->select('tb_kategori.id_kategori,tb_kategori.kategori,tb_peminjaman.*, tb_aset.nama as nama_aset');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_peminjaman.id_aset = tb_aset.id_aset');
        $this->db->join('tb_kategori', 'tb_aset.id_kategori = tb_kategori.id_kategori');
        $this->db->order_by('tb_peminjaman.tgl_mulai', 'DESC'); // Urutkan berdasarkan tgl_mulai terbaru
        return $this->db->get()->result_array();
    }

    public function getFiltered($id_aset = null, $tgl_mulai = null, $tgl_selesai = null, $status = null)
    {

        if ($id_aset && !is_numeric($id_aset)) {
            return []; 
        }

        if ($tgl_mulai && !strtotime($tgl_mulai)) {
            return []; 
        }

        if ($tgl_selesai && !strtotime($tgl_selesai)) {
            return []; 
        }

        $this->db->select('tb_kategori.id_kategori,tb_kategori.kategori,tb_peminjaman.*, tb_aset.nama as nama_aset');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_peminjaman.id_aset = tb_aset.id_aset');
        $this->db->join('tb_kategori', 'tb_aset.id_kategori = tb_kategori.id_kategori');

        if ($id_aset) {
            $this->db->where('tb_peminjaman.id_aset', $id_aset);
        }

        if ($status) {
            $this->db->where('tb_peminjaman.status', $status);
        }

        if ($tgl_mulai && $tgl_selesai) {
            $tgl_selesai_plusatu = date('Y-m-d', strtotime($tgl_selesai . ' +1 day'));
            $this->db->where("tb_peminjaman.tgl_mulai >=", $tgl_mulai);
            $this->db->where("tb_peminjaman.tgl_selesai <=", $tgl_selesai_plusatu);
        } elseif ($tgl_mulai) {
            $this->db->where("tb_peminjaman.tgl_mulai >=", $tgl_mulai);
        } elseif ($tgl_selesai) {
            $tgl_selesai_plusatu = date('Y-m-d', strtotime($tgl_selesai . ' +1 day'));
            $this->db->where("tb_peminjaman.tgl_selesai <=", $tgl_selesai_plusatu);
        }

        $this->db->order_by('tb_peminjaman.tgl_mulai', 'DESC');
        return $this->db->get()->result_array();


    }

}

?>
