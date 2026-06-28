<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{


    public function users()
    {

        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAllMenu()
    {
        return $query = $this->db->get('user_menu')->result_array();
    }

    public function AddData()
    {
        $this->db->select_max('no_urut');
        $this->db->from('user_menu');
        $query = $this->db->get();

        $result = $query->row_array();
        $max_no_urut = $result['no_urut'];


        $data = [
            "title"         => htmlspecialchars($this->input->post('title', true)),
            "desc"         => htmlspecialchars($this->input->post('desc', true)),
            "url"           => htmlspecialchars($this->input->post('url', true)),
            "icon"          => htmlspecialchars($this->input->post('icon', true)),
            "is_main_menu"  => htmlspecialchars($this->input->post('is_main_menu', true)),
            "is_active"     => htmlspecialchars($this->input->post('is_active', true)),
            "no_urut"     => $max_no_urut + 1
        ];

        $this->db->insert('user_menu', $data);
    }


    public function EditData()
    {
        $data = [
            "title"         => htmlspecialchars($this->input->post('title', true)),
            "desc"         => htmlspecialchars($this->input->post('desc', true)),
            "url"           => htmlspecialchars($this->input->post('url', true)),
            "icon"          => htmlspecialchars($this->input->post('icon', true)),
            "is_main_menu"  => htmlspecialchars($this->input->post('is_main_menu', true)),
            "is_active"     => htmlspecialchars($this->input->post('is_active', true)),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function getById($id) // memanggil semua data didatabase untuk ditampilkan 
    {

        return $this->db->get_where('user_menu', ['id' => $id])->row();
    }


    public function DeleteData($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
    }

    public function getMenuByUrl($url)
    {
        // Ambil menu berdasarkan URL
        $this->db->where('url', $url);
        $menu = $this->db->get('user_menu')->row_array();

        // Jika ini sub-menu, ambil main menu-nya
        if ($menu['is_main_menu'] != 0) {
            $this->db->where('id', $menu['is_main_menu']);
            $main_menu = $this->db->get('user_menu')->row_array();
            $menu['main_menu'] = $main_menu['title'];
        } else {
            $menu['main_menu'] = 'Home';
        }

        return $menu;
    }




}
