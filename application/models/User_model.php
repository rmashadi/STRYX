<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{


    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll($role_id)
    {   
        $where = '';
        if ($role_id !=1) {
            $where = $this->db->where('user.role_id NOT IN (1)');
        }

        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id=user.role_id', 'LEFT');
        $where;
        return $this->db->get()->result_array();
    }

    public function getAllUsers($role_id) {
        $where = '';
        if ($role_id !=1) {
            $where = $this->db->where('user.role_id NOT IN (1)');
        }
        $this->db->from('user');
        $where;
        return $this->db->get()->result_array();
    }

    public function AddData()
    {
        $password = $this->input->post('password', true);
        $data = [
            "name"         => htmlspecialchars($this->input->post('name', true)),
            "username"     => htmlspecialchars($this->input->post('username', true)),
            "email"        => htmlspecialchars($this->input->post('email', true)),
            "image"        => 'default.jpg',
            "password"     => password_hash($password, PASSWORD_DEFAULT),
            "role_id"      => htmlspecialchars($this->input->post('role_id', true)),
            "is_active"    => htmlspecialchars($this->input->post('is_active', true)),
            "date_created" => date('d/m/Y H:i:s A')

        ];

        $this->db->insert('user', $data);
    }


    public function EditData()
    {
        $password = $this->input->post('password', true);
        $data = [
            "name"         => htmlspecialchars($this->input->post('name', true)),
            "username"     => htmlspecialchars($this->input->post('username', true)),
            "email"        => htmlspecialchars($this->input->post('email', true)),
            "role_id"      => htmlspecialchars($this->input->post('role_id', true)),
            "is_active"    => htmlspecialchars($this->input->post('is_active', true)),
            "date_created" => date('d/m/Y H:i:s A')

        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->db->where('id_user', htmlspecialchars($this->input->post('id_user', true)));
        $this->db->update('user', $data);
    }

    public function getById($id) // memanggil semua data didatabase untuk ditampilkan 
    {

        return $this->db->get_where('user', ['id_user' => $id])->row();
    }


    public function DeleteData($id)
    {
        $this->db->delete('user', ['id_user' => $id]);
    }
}
