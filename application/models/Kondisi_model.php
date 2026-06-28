<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kondisi_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_kondisi')->result_array();
    }

    public function AddData()
    {
        $data = [
            "kondisi" => htmlspecialchars($this->input->post('kondisi', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
        ];

        $this->db->insert('tb_kondisi', $data);
    }

    public function EditData()
    {
        $data = [
            "kondisi" => htmlspecialchars($this->input->post('kondisi', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
        ];

        $this->db->where('id_kondisi', htmlspecialchars($this->input->post('id_kondisi')));
        $this->db->update('tb_kondisi', $data);
    }

    public function getById($id_kondisi)
    {
        return $this->db->get_where('tb_kondisi', ['id_kondisi' => $id_kondisi])->row_array();
    }

    public function DeleteData($id_kondisi)
    {
        $this->db->delete('tb_kondisi', ['id_kondisi' => $id_kondisi]);
    }
}
