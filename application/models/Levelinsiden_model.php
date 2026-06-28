<?php defined('BASEPATH') or exit('No direct script access allowed');

class Levelinsiden_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_level_insiden')->result_array();
    }

    public function AddData()
    {
        $data = [
            "level_insiden" => htmlspecialchars($this->input->post('level_insiden', true)),
        ];

        $this->db->insert('tb_level_insiden', $data);
    }

    public function EditData()
    {
        $data = [
            "level_insiden" => htmlspecialchars($this->input->post('level_insiden', true)),
        ];

        $this->db->where('id_level_insiden', htmlspecialchars($this->input->post('id_level_insiden')));
        $this->db->update('tb_level_insiden', $data);
    }

    public function getById($id_jenis_insiden)
    {
        return $this->db->get_where('tb_level_insiden', ['id_level_insiden' => $id_level_insiden])->row_array();
    }

    public function DeleteData($id_level_insiden)
    {
        $this->db->delete('tb_level_insiden', ['id_level_insiden' => $id_level_insiden]);
    }
}
