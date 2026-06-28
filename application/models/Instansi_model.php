<?php defined('BASEPATH') or exit('No direct script access allowed');

class Instansi_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->order_by('kode_instansi', 'ASC')->get('tb_instansi')->result_array();
    }

    public function AddData()
    {
        $data = [
            // "kode_instansi" => htmlspecialchars($this->input->post('kode_instansi', true)),
            "instansi" => htmlspecialchars($this->input->post('instansi', true)),
            // "alamat" => htmlspecialchars($this->input->post('alamat', true)),
        ];

        $this->db->insert('tb_instansi', $data);
    }

    public function EditData()
    {
        $data = [
            // "kode_instansi" => htmlspecialchars($this->input->post('kode_instansi', true)),
            "instansi" => htmlspecialchars($this->input->post('instansi', true)),
            // "alamat" => htmlspecialchars($this->input->post('alamat', true)),
        ];

        $this->db->where('id_instansi', htmlspecialchars($this->input->post('id_instansi')));
        $this->db->update('tb_instansi', $data);
    }

    public function getById($id_instansi)
    {
        return $this->db->get_where('tb_instansi', ['id_instansi' => $id_instansi])->row_array();
    }

    public function DeleteData($id_instansi)
    {
        $this->db->delete('tb_instansi', ['id_instansi' => $id_instansi]);
    }
}
