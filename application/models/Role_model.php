<?php defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{

    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll($role_id)
    {
        $where = '';
        if ($role_id !=1) {
            $where = $this->db->where('id NOT IN (1)');
        }

        $this->db->from('user_role');
        $where;
        return $query = $this->db->get()->result_array();
    }

    public function AddData()
    {

        $data = [
            "role"         => htmlspecialchars($this->input->post('role', true)),
        ];

        $this->db->insert('user_role', $data);
    }


    public function EditData()
    {
        $data = [
            "role"         => htmlspecialchars($this->input->post('role', true)),
        ];

        $this->db->where('id', htmlspecialchars($this->input->post('id')));
        $this->db->update('user_role', $data);
    }

    public function getById($id) // memanggil semua data didatabase untuk ditampilkan 
    {

        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function getRoleAccess($role_id) // memanggil semua data didatabase untuk ditampilkan 
    {

        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }


    public function DeleteData($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }
}
