<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenisserangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Jenisserangan_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Jenisserangan_model->users();
        $data['title'] = 'Jenis serangan Management';
        $data['jenisserangan'] = $this->Jenisserangan_model->getAll();
        $this->form_validation->set_rules('jenis_serangan', 'jenis_serangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/jenisserangan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Jenisserangan_model->AddData();
            $this->session->set_flashdata('add', 'Jenis serangan berhasil ditambahkan!');
            redirect('jenisserangan/index');
        }
    }

    public function edit()
    {
        $this->Jenisserangan_model->EditData();
        $this->session->set_flashdata('edit', 'Jenis serangan berhasil diubah!');
        redirect('jenisserangan');
    }

    public function delete($id_jenis_serangan)
    {
        $this->Jenisserangan_model->DeleteData($id_jenis_serangan);
        $this->session->set_flashdata('delete', 'Jenis serangan berhasil dihapus!');
        redirect('jenisserangan');
    }
}
