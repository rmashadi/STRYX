<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Domain extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Domain_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Domain_model->users();
        $data['title'] = 'Domain Management';
        $data['domain'] = $this->Domain_model->getAll();
        $data['instansi'] = $this->Domain_model->getInstansi(); // Ambil data instansi
        $data['platform'] = $this->Domain_model->getPlatform(); // Ambil data platform
        $data['subdomain'] = $this->Domain_model->getSubdomain(); // Ambil data Subdomain
        $data['geopasial'] = $this->Domain_model->getGeopasial(); // Ambil data instansi
        $data['pribadi'] = $this->Domain_model->getPribadi(); // Ambil data pribadi
        $data['kat_aplikasi'] = $this->Domain_model->getKataplikasi(); // Ambil data Kat Aplikasi
        $data['status_api'] = $this->Domain_model->getStatusApi(); // Ambil data API
        $data['status_sdm'] = $this->Domain_model->getStatusSdm(); // Ambil data SDM
        $data['status_aplikasi'] = $this->Domain_model->getStatusAplikasi(); // Ambil data Aplikasi
        $this->form_validation->set_rules('Domain', 'Domain', 'required');
        $this->form_validation->set_rules('id_instansi', 'Instansi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/domain/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Domain_model->AddData();
            $this->session->set_flashdata('add', 'Data Domain berhasil ditambahkan!');
            redirect('Domain/index');
        }
    }

    public function edit()
    {
        $this->Domain_model->EditData();
        $this->session->set_flashdata('edit', 'Domain berhasil diubah!');
        redirect('Domain');
    }

    public function delete($id_Domain)
    {
        $this->Domain_model->DeleteData($id_Domain);
        $this->session->set_flashdata('delete', 'Domain berhasil dihapus!');
        redirect('Domain');
    }
}
