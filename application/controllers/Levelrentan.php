<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Levelrentan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Levelrentan_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Levelrentan_model->users();
        $data['title'] = 'Level Kerentanan Management';
        $data['levelrentan'] = $this->Levelrentan_model->getAll();
        $this->form_validation->set_rules('levelrentan', 'Level Rentan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/levelrentan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Levelrentan_model->AddData();
            $this->session->set_flashdata('add', 'level kerentanan berhasil ditambahkan!');
            redirect('levelrentan/index');
        }
    }

    public function edit()
    {
        $this->Levelrentan_model->EditData();
        $this->session->set_flashdata('edit', 'Level kerentanan berhasil diubah!');
        redirect('levelrentan');
    }

    public function delete($id_level_rentan)
    {
        $this->Levelrentan_model->DeleteData($id_level_rentan);
        $this->session->set_flashdata('delete', 'Level Kerentanan berhasil dihapus!');
        redirect('levelrentan');
    }
}
