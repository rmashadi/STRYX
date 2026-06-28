<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenisinsiden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Jenisinsiden_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Jenisinsiden_model->users();
        $data['title'] = 'Jenis Insiden Management';
        $data['jenisinsiden'] = $this->Jenisinsiden_model->getAll();
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/jenisinsiden/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Jenisinsiden_model->AddData();
            $this->session->set_flashdata('add', 'Jenis Insiden berhasil ditambahkan!');
            redirect('jenisinsiden/index');
        }
    }

    public function edit()
    {
        $this->Jenisinsiden_model->EditData();
        $this->session->set_flashdata('edit', 'Kategori berhasil diubah!');
        redirect('jenisinsiden');
    }

    public function delete($id_jenis_insiden)
    {
        $this->Jenisinsiden_model->DeleteData($id_jenis_insiden);
        $this->session->set_flashdata('delete', 'Jenis Insiden berhasil dihapus!');
        redirect('jenisinsiden');
    }
}
