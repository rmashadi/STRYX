<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kondisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Kondisi_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Kondisi_model->users();
        $data['title'] = 'Kondisi Barang Management';
        $data['kondisi'] = $this->Kondisi_model->getAll();
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/kondisi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Kondisi_model->AddData();
            $this->session->set_flashdata('add', 'Kondisi berhasil ditambahkan!');
            redirect('kondisi/index');
        }
    }

    public function edit()
    {
        $this->Kondisi_model->EditData();
        $this->session->set_flashdata('edit', 'Kondisi berhasil diubah!');
        redirect('kondisi');
    }

    public function delete($id_kondisi)
    {
        $this->Kondisi_model->DeleteData($id_kondisi);
        $this->session->set_flashdata('delete', 'Kondisi berhasil dihapus!');
        redirect('kondisi');
    }
}
