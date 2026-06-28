<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Levelserangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Levelserangan_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Levelserangan_model->users();
        $data['title'] = 'Level Keseranganan Management';
        $data['levelserangan'] = $this->Levelserangan_model->getAll();
        $this->form_validation->set_rules('level_serangan', 'level serangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/levelserangan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Levelserangan_model->AddData();
            $this->session->set_flashdata('add', 'level keseranganan berhasil ditambahkan!');
            redirect('levelserangan/index');
        }
    }

    public function edit()
    {
        $this->Levelserangan_model->EditData();
        $this->session->set_flashdata('edit', 'Level keseranganan berhasil diubah!');
        redirect('levelserangan');
    }

    public function delete($id_level_serangan)
    {
        $this->Levelserangan_model->DeleteData($id_level_serangan);
        $this->session->set_flashdata('delete', 'Level Keseranganan berhasil dihapus!');
        redirect('levelserangan');
    }
}
