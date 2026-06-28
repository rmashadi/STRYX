<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Profile_model');
        $this->load->model('Menu_model');
        is_logged_in(); // mengecek role management yang diberi akses
    }
    public function index() //untuk tampilkan seluruh data dari database
    {

        $data['user']   = $this->Profile_model->users();
        $data['title'] = 'My Profile';

        $this->form_validation->set_rules('name', 'full name', 'required|trim');
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
        $this->form_validation->set_rules('instansi', 'instansi', 'required|trim');

        $url = $this->uri->segment(1); // Mengambil segmen pertama dari URL
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('utility/profile/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Profile_model->EditData();
            $this->session->set_flashdata('edit', 'Ubah');
            redirect('profile');
        }
    }
}
