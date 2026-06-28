<?php defined('BASEPATH') or exit('No direct script access allowed');

class Catatanlevel_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('tb_catatan_level')->result_array();
    }

    public function AddData()
    {
        $data = [
            "tanggal" => htmlspecialchars($this->input->post('tanggal', true)),
            "jumlah_serangan_high" => htmlspecialchars($this->input->post('jumlah_serangan_high', true)),
            "jumlah_serangan_medium" => htmlspecialchars($this->input->post('jumlah_serangan_medium', true)),
            "jumlah_serangan_low" => htmlspecialchars($this->input->post('jumlah_serangan_low', true)),
            "user_input" => $this->session->userdata('name'),
            "tgl_input" => (date('Y-m-d H:i:s')),
           
        ];

   

        $this->db->insert('tb_catatan_level', $data);
    }

    public function EditData()
    {
        $data = [
             "tanggal" => htmlspecialchars($this->input->post('tanggal', true)),
            "jumlah_serangan_high" => htmlspecialchars($this->input->post('jumlah_serangan_high', true)),
            "jumlah_serangan_medium" => htmlspecialchars($this->input->post('jumlah_serangan_medium', true)),
            "jumlah_serangan_low" => htmlspecialchars($this->input->post('jumlah_serangan_low', true)),
            "user_update" => $this->session->userdata('name'),
            "tgl_update" => (date('Y-m-d H:i:s')),
        ];

        $this->db->where('id_catatan_level', htmlspecialchars($this->input->post('id_catatan_level')));
        $this->db->update('tb_catatan_level', $data);
    }

    public function getById($id_catatan_level)
    {
        return $this->db->get_where('tb_catatan_level', ['id_catatan_level' => $id_catatan_level])->row_array();
    }

    public function DeleteData($id_catatan_level)
    {
        $this->db->delete('tb_catatan_level', ['id_catatan_level' => $id_catatan_level]);
    }
}
