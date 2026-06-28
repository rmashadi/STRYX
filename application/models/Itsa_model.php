<?php defined('BASEPATH') or exit('No direct script access allowed');

class Itsa_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getUsers()
    {
        return $this->db->get('user')->result_array(); // Ambil semua user
    }

    public function getAll()
    {
        $this->db->select('tb_layanan_itsa.*, tb_instansi.instansi');
        $this->db->from('tb_layanan_itsa');
        $this->db->join('tb_instansi', 'tb_instansi.id_instansi = tb_layanan_itsa.id_instansi');
        return $this->db->get()->result_array();
    }

    public function getAllLevelRentan()
    {
        $this->db->select('tb_level_rentan.*');
        $this->db->from('tb_level_rentan');
        return $this->db->get()->result_array();
    }

    public function getById($id)
    {
        $this->db->select('tb_layanan_itsa.*, tb_instansi.instansi');
        $this->db->from('tb_layanan_itsa');
        $this->db->join('tb_instansi', 'tb_instansi.id_instansi = tb_layanan_itsa.id_instansi');
        $this->db->where('id_layanan', $id);
        return $this->db->get()->row_array();
    }

    public function insert($data)
    {
        // print_r($data); exit();
        return $this->db->insert('tb_layanan_itsa', $data);
        echo $this->db->last_query(); // menampilkan query INSERT
        exit(); // hentikan eksekusi agar tidak lanjut redirect
    }

    public function update($id, $data)
    {
        $this->db->where('id_layanan', $id);
        return $this->db->update('tb_layanan_itsa', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('tb_layanan_itsa', ['id_layanan' => $id]);
    }

    public function deleteperbaikan($id)
    {
        return $this->db->delete('tb_perbaikan_itsa', ['id_perbaikan' => $id]);
    }

    public function deletekerentanan($id)
    {
        return $this->db->delete('tb_listkerentanan', ['id_list' => $id]);
    }

    public function insertKerentanan($data)
    {
        return $this->db->insert('tb_listkerentanan', $data);
    }

    public function getByLayanan($id_layanan)
    {
        $this->db->select('tb_listkerentanan.id_list,tb_level_rentan.level_rentan, tb_listkerentanan.jumlah');
        $this->db->from('tb_listkerentanan');
        $this->db->join('tb_level_rentan', 'tb_level_rentan.id_level_rentan = tb_listkerentanan.id_level_rentan');
        $this->db->where('tb_listkerentanan.id_layanan', $id_layanan);
        return $this->db->get()->result_array();
    }

    public function getPerbaikanByLayanan($id_layanan)
    {
        return $this->db->get_where('tb_perbaikan_itsa', ['id_layanan' => $id_layanan])->result_array();
    }


    public function insertPerbaikan($data)
    {
        return $this->db->insert('tb_perbaikan_itsa', $data);
    }


}
