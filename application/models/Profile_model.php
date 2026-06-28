<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{


    public function users()
    {
        $this->db->join('user_role', 'user_role.id=user.role_id', 'LEFT');
        
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function EditData()
    {

        $name  = htmlspecialchars($this->input->post('name', TRUE));
        $email = htmlspecialchars($this->input->post('email', TRUE));
        $no_hp = htmlspecialchars($this->input->post('no_hp', TRUE));
        $instansi = htmlspecialchars($this->input->post('instansi', TRUE));
        $id_user = htmlspecialchars($this->input->post('id_user', TRUE));

        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['upload_path']   = './assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->set('name', $name);
        $this->db->set('email', $email);
        $this->db->set('no_hp', $no_hp);
        $this->db->set('instansi', $instansi);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }
}
