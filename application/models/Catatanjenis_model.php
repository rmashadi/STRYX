<?php defined('BASEPATH') or exit('No direct script access allowed');

class Catatanjenis_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        // return $this->db->get('tb_catatan_jenis')->result_array();
        $this->db->select(' tb_catatan_jenis.*, js1.id_jenis_serangan AS id_jenis_serangan_1,  js1.jenis_serangan AS jenis_serangan_1, js2.id_jenis_serangan AS id_jenis_serangan_2, js2.jenis_serangan AS jenis_serangan_2, js3.id_jenis_serangan AS id_jenis_serangan_3, js3.jenis_serangan AS jenis_serangan_3, js4.id_jenis_serangan AS id_jenis_serangan_4, js4.jenis_serangan AS jenis_serangan_4, js5.id_jenis_serangan AS id_jenis_serangan_5, js5.jenis_serangan AS jenis_serangan_5');
        $this->db->from('tb_catatan_jenis');
        $this->db->join('tb_jenis_serangan AS js1', 'tb_catatan_jenis.jenis_serangan_1 = js1.id_jenis_serangan');
        $this->db->join('tb_jenis_serangan AS js2', 'tb_catatan_jenis.jenis_serangan_2 = js2.id_jenis_serangan');
        $this->db->join('tb_jenis_serangan AS js3', 'tb_catatan_jenis.jenis_serangan_3 = js3.id_jenis_serangan');
        $this->db->join('tb_jenis_serangan AS js4', 'tb_catatan_jenis.jenis_serangan_4 = js4.id_jenis_serangan');
        $this->db->join('tb_jenis_serangan AS js5', 'tb_catatan_jenis.jenis_serangan_5 = js5.id_jenis_serangan');
        return $this->db->get()->result_array();
    }

    public function AddData()
    {
        $data = [

            "tanggal" => htmlspecialchars($this->input->post('tanggal', true)),
            "jenis_serangan_1" => htmlspecialchars($this->input->post('jenis_serangan_1', true)),
            "jumlah_1" => htmlspecialchars($this->input->post('jumlah_1', true)),
            "jenis_serangan_2" => htmlspecialchars($this->input->post('jenis_serangan_2', true)),
            "jumlah_2" => htmlspecialchars($this->input->post('jumlah_2', true)),
            "jenis_serangan_3" => htmlspecialchars($this->input->post('jenis_serangan_3', true)),
            "jumlah_3" => htmlspecialchars($this->input->post('jumlah_3', true)),
            "jenis_serangan_4" => htmlspecialchars($this->input->post('jenis_serangan_4', true)),
            "jumlah_4" => htmlspecialchars($this->input->post('jumlah_4', true)),
            "jenis_serangan_5" => htmlspecialchars($this->input->post('jenis_serangan_5', true)),
            "jumlah_5" => htmlspecialchars($this->input->post('jumlah_5', true)),
            "user_input" => $this->session->userdata('name'),
            "tgl_input" => (date('Y-m-d H:i:s')),
           
        ];

        // print_r($data);exit;

        $this->db->insert('tb_catatan_jenis', $data);
    }

    public function EditData()
    {
        $data = [

            "tanggal" => htmlspecialchars($this->input->post('tanggal', true)),
            "jenis_serangan_1" => htmlspecialchars($this->input->post('id_jenis_serangan_1', true)),
            "jumlah_1" => htmlspecialchars($this->input->post('jumlah_1', true)),
            "jenis_serangan_2" => htmlspecialchars($this->input->post('id_jenis_serangan_2', true)),
            "jumlah_2" => htmlspecialchars($this->input->post('jumlah_2', true)),
            "jenis_serangan_3" => htmlspecialchars($this->input->post('id_jenis_serangan_3', true)),
            "jumlah_3" => htmlspecialchars($this->input->post('jumlah_3', true)),
            "jenis_serangan_4" => htmlspecialchars($this->input->post('id_jenis_serangan_4', true)),
            "jumlah_4" => htmlspecialchars($this->input->post('jumlah_4', true)),
            "jenis_serangan_5" => htmlspecialchars($this->input->post('id_jenis_serangan_5', true)),
            "jumlah_5" => htmlspecialchars($this->input->post('jumlah_5', true)),
            "user_update" => $this->session->userdata('name'),
            "tgl_update" => (date('Y-m-d H:i:s')),
           
        ];
        // print_r($data);exit;
        $this->db->where('id_catatan_jenis', htmlspecialchars($this->input->post('id_catatan_jenis')));
        $this->db->update('tb_catatan_jenis', $data);
    }

    public function getById($id_catatan_jenis)
    {
        return $this->db->get_where('tb_catatan_jenis', ['id_catatan_jenis' => $id_catatan_jenis])->row_array();
    }

    public function DeleteData($id_catatan_jenis)
    {
        $this->db->delete('tb_catatan_jenis', ['id_catatan_jenis' => $id_catatan_jenis]);
    }

         public function getJenisserangan()
    {
        return $this->db->get('tb_jenis_serangan')->result_array();
    }
}
