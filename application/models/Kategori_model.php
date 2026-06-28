<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_kategori')->result_array();
    }

    public function AddData()
    {
        $data = [
            "kategori" => htmlspecialchars($this->input->post('kategori', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
        ];

        $this->db->insert('tb_kategori', $data);
    }

    public function EditData()
    {
        $data = [
            "kategori" => htmlspecialchars($this->input->post('kategori', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
        ];

        $this->db->where('id_kategori', htmlspecialchars($this->input->post('id_kategori')));
        $this->db->update('tb_kategori', $data);
    }

    public function getById($id_kategori)
    {
        return $this->db->get_where('tb_kategori', ['id_kategori' => $id_kategori])->row_array();
    }

    public function DeleteData($id_kategori)
    {
        $this->db->delete('tb_kategori', ['id_kategori' => $id_kategori]);
    }
}
