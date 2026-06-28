<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Levelinsiden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Levelinsiden_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Levelinsiden_model->users();
        $data['title'] = 'Level Keinsidenan Management';
        $data['levelinsiden'] = $this->Levelinsiden_model->getAll();
        $this->form_validation->set_rules('level_insiden', 'level insiden', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/levelinsiden/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Levelinsiden_model->AddData();
            $this->session->set_flashdata('add', 'level keinsidenan berhasil ditambahkan!');
            redirect('levelinsiden/index');
        }
    }

    public function edit()
    {
        $this->Levelinsiden_model->EditData();
        $this->session->set_flashdata('edit', 'Level keinsidenan berhasil diubah!');
        redirect('levelinsiden');
    }

    public function delete($id_level_insiden)
    {
        $this->Levelinsiden_model->DeleteData($id_level_insiden);
        $this->session->set_flashdata('delete', 'Level Keinsidenan berhasil dihapus!');
        redirect('levelinsiden');
    }
}
