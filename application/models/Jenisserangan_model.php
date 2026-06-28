<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenisserangan_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_jenis_serangan')->result_array();
    }

    public function AddData()
    {
        $data = [
            "jenis_serangan" => htmlspecialchars($this->input->post('jenis_serangan', true)),
        ];

        $this->db->insert('tb_jenis_serangan', $data);
    }

    public function EditData()
    {
        $data = [
            "jenis_serangan" => htmlspecialchars($this->input->post('jenis_serangan', true)),
        ];

        $this->db->where('id_jenis_serangan', htmlspecialchars($this->input->post('id_jenis_serangan')));
        $this->db->update('tb_jenis_serangan', $data);
    }

    public function getById($id_jenis_serangan)
    {
        return $this->db->get_where('tb_jenis_serangan', ['id_jenis_serangan' => $id_jenis_serangan])->row_array();
    }

    public function DeleteData($id_jenis_serangan)
    {
        $this->db->delete('tb_jenis_serangan', ['id_jenis_serangan' => $id_jenis_serangan]);
    }
}
