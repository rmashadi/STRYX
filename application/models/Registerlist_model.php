<?php defined('BASEPATH') or exit('No direct script access allowed');

class Registerlist_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        $this->db->select('register.*');
        $this->db->from('register');
        $this->db->order_by('register.date_created', 'ASC');
        return $this->db->get()->result_array();
    }


}
?>
