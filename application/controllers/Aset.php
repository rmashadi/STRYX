<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Aset_model');
        is_logged_in(); // Sesuaikan dengan method otentikasi Anda
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Aset_model->users();
        $data['title'] = 'Aset Management';
        $data['aset'] = $this->Aset_model->getAll();
        $data['categories'] = $this->Aset_model->getCategories(); // Ambil data kategori
        $data['kondisi'] = $this->Aset_model->getKondisi(); // Ambil data kategori
        $this->form_validation->set_rules('kd_aset', 'Kode Aset', 'required');
        $this->form_validation->set_rules('nama', 'Nama Aset', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('id_kondisi', 'Kondisi Aset', 'required');
        $this->form_validation->set_rules('is_aktif', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/aset/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Aset_model->AddData();
            $this->session->set_flashdata('add', 'Ditambahkan');
            redirect('aset');
        }
    }

    public function edit()
    {
        
        $this->Aset_model->EditData();
        $this->session->set_flashdata('edit', 'Diubah');
        redirect('aset');
    }

    public function delete($id_aset)
    {
        $this->Aset_model->DeleteData($id_aset);
        $this->session->set_flashdata('delete', 'Dihapus');
        redirect('aset');
    }
}
