<?php defined('BASEPATH') or exit('No direct script access allowed');

class Levelserangan_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_level_serangan')->result_array();
    }

    public function AddData()
    {
        $data = [
            "level_serangan" => htmlspecialchars($this->input->post('level_serangan', true)),
        ];

        $this->db->insert('tb_level_serangan', $data);
    }

    public function EditData()
    {
        $data = [
            "level_serangan" => htmlspecialchars($this->input->post('level_serangan', true)),
        ];

        $this->db->where('id_level_serangan', htmlspecialchars($this->input->post('id_level_serangan')));
        $this->db->update('tb_level_serangan', $data);
    }

    public function getById($id_jenis_insiden)
    {
        return $this->db->get_where('tb_level_serangan', ['id_level_serangan' => $id_level_serangan])->row_array();
    }

    public function DeleteData($id_level_serangan)
    {
        $this->db->delete('tb_level_serangan', ['id_level_serangan' => $id_level_serangan]);
    }
}
