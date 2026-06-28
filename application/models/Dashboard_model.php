<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_total_users()
    {
        return $this->db->count_all('user'); // Total pengguna
    }

    public function get_total_aset()
    {
        return $this->db->count_all('tb_aset'); // Total aset
    }

    public function get_total_peminjaman()
    {
        return $this->db->count_all('tb_peminjaman'); // Total peminjaman
    }

    public function total_peminjaman_hariini()
    {
        $tgl_sekarang = date('Y-m-d'); // Ambil hanya bagian tanggal (YYYY-MM-DD)
        $this->db->like('tgl_mulai', $tgl_sekarang, 'after'); // Gunakan LIKE dengan format YYYY-MM-DD%
        return $this->db->count_all_results('tb_peminjaman'); // Hitung total hasil
    }

    public function get_top_aset()
    {
        $this->db->select('tb_aset.nama, COUNT(tb_peminjaman.id_aset) as total');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_aset.id_aset = tb_peminjaman.id_aset');
        $this->db->group_by('tb_peminjaman.id_aset');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5); // Ambil aset yang sering dipinjam
        return $this->db->get()->result_array();
    }

    public function get_kondisi_aset()
    {
        $this->db->select('tb_kondisi.kondisi, COUNT(tb_aset.id_kondisi) as total');
        $this->db->from('tb_aset');
        $this->db->join('tb_kondisi', 'tb_kondisi.id_kondisi = tb_aset.id_kondisi');
        $this->db->group_by('tb_kondisi.id_kondisi');
        return $this->db->get()->result_array();
    }

    public function get_total_pending()
    {
        $this->db->select('COUNT(id_peminjaman) as total_pending');
        $this->db->from('tb_peminjaman');
        $this->db->where("status = 'pending'");
        return $this->db->count_all_results(); // Hitung total hasil
    }

}
