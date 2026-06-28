<?php defined('BASEPATH') or exit('No direct script access allowed');

class Levelrentan_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_level_rentan')->result_array();
    }

    public function AddData()
    {
        $data = [
            "level_rentan" => htmlspecialchars($this->input->post('level_rentan', true)),
        ];

        $this->db->insert('tb_level_rentan', $data);
    }

    public function EditData()
    {
        $data = [
            "level_rentan" => htmlspecialchars($this->input->post('level_rentan', true)),
        ];

        $this->db->where('id_level_rentan', htmlspecialchars($this->input->post('id_level_rentan')));
        $this->db->update('tb_level_rentan', $data);
    }

    public function getById($id_jenis_insiden)
    {
        return $this->db->get_where('tb_level_rentan', ['id_level_rentan' => $id_level_rentan])->row_array();
    }

    public function DeleteData($id_level_rentan)
    {
        $this->db->delete('tb_level_rentan', ['id_level_rentan' => $id_level_rentan]);
    }
}
