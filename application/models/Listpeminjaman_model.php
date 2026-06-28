<?php defined('BASEPATH') or exit('No direct script access allowed');

class Listpeminjaman_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        $this->db->select('tb_peminjaman.*, tb_aset.nama as nama_aset');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_peminjaman.id_aset = tb_aset.id_aset');
        $this->db->order_by("FIELD(tb_peminjaman.status, 'pending', 'approved', 'rejected', 'completed')", NULL, FALSE);
        $this->db->order_by('tb_peminjaman.tgl_mulai', 'DESC'); // Urutkan berdasarkan tgl_mulai terbaru
        return $this->db->get()->result_array();
    }

    public function addPeminjaman($data)
    {
        $this->db->insert('tb_peminjaman', $data);
    }

    public function checkAvailability($id_aset, $tgl_mulai, $tgl_selesai)
    {
        $this->db->where('id_aset', $id_aset);
        $this->db->where('(tgl_mulai BETWEEN "'. $tgl_mulai .'" AND "'. $tgl_selesai .'")', null, false);
        $this->db->or_where('(tgl_selesai BETWEEN "'. $tgl_mulai .'" AND "'. $tgl_selesai .'")', null, false);
        $query = $this->db->get('tb_peminjaman');
        return $query->num_rows();
    }

    // Function to get a specific peminjaman by id
    public function get_peminjaman_by_id($id_peminjaman) {
        return $this->db->get_where('tb_peminjaman', ['id_peminjaman' => $id_peminjaman])->row_array();
    }

    // Function to update peminjaman
    public function update_peminjaman($id_peminjaman, $data) {
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->update('tb_peminjaman', $data);
    }

    // Function to delete peminjaman
    public function delete_peminjaman($id_peminjaman) {
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->delete('tb_peminjaman');
    }
}
?>
