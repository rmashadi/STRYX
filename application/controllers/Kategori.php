<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Kategori_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Kategori_model->users();
        $data['title'] = 'Kategori Management';
        $data['kategori'] = $this->Kategori_model->getAll();
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/kategori/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Kategori_model->AddData();
            $this->session->set_flashdata('add', 'Kategori berhasil ditambahkan!');
            redirect('kategori/index');
        }
    }

    public function edit()
    {
        $this->Kategori_model->EditData();
        $this->session->set_flashdata('edit', 'Kategori berhasil diubah!');
        redirect('kategori');
    }

    public function delete($id_kategori)
    {
        $this->Kategori_model->DeleteData($id_kategori);
        $this->session->set_flashdata('delete', 'Kategori berhasil dihapus!');
        redirect('kategori');
    }
}
