<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Instansi_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Instansi_model->users();
        $data['title'] = 'Instansi Management';
        $data['instansi'] = $this->Instansi_model->getAll();
        $this->form_validation->set_rules('instansi', 'instansi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/instansi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Instansi_model->AddData();
            $this->session->set_flashdata('add', 'Instansi berhasil ditambahkan!');
            redirect('instansi/index');
        }
    }

    public function edit()
    {
        $this->Instansi_model->EditData();
        $this->session->set_flashdata('edit', 'Instansi berhasil diubah!');
        redirect('instansi');
    }

    public function delete($id_instansi)
    {
        $this->Instansi_model->DeleteData($id_instansi);
        $this->session->set_flashdata('delete', 'Instansi berhasil dihapus!');
        redirect('instansi');
    }
}
