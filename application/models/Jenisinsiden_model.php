<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenisinsiden_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_jenis_insiden')->result_array();
    }

    public function AddData()
    {
        $data = [
            "jenis_insiden" => htmlspecialchars($this->input->post('jenis_insiden', true)),
        ];

        $this->db->insert('tb_jenis_insiden', $data);
    }

    public function EditData()
    {
        $data = [
            "jenis_insiden" => htmlspecialchars($this->input->post('jenis_insiden', true)),
        ];

        $this->db->where('id_jenis_insiden', htmlspecialchars($this->input->post('id_jenis_insiden')));
        $this->db->update('tb_jenis_insiden', $data);
    }

    public function getById($id_jenis_insiden)
    {
        return $this->db->get_where('tb_jenis_insiden', ['id_jenis_insiden' => $id_jenis_insiden])->row_array();
    }

    public function DeleteData($id_jenis_insiden)
    {
        $this->db->delete('tb_jenis_insiden', ['id_jenis_insiden' => $id_jenis_insiden]);
    }
}
