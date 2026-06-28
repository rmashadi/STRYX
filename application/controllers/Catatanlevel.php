<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatanlevel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Catatanlevel_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Catatanlevel_model->users();
        $data['title'] = 'Pencatatan Level Management';
        $data['catatanlevel'] = $this->Catatanlevel_model->getAll();
        
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jumlah_serangan_high', 'Jumlah Serangan High', 'required|numeric');
        $this->form_validation->set_rules('jumlah_serangan_medium', 'Jumlah Serangan Medium', 'required|numeric');
        $this->form_validation->set_rules('jumlah_serangan_low', 'Jumlah Serangan Low', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('percobaanserangan/catatanlevel/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Catatanlevel_model->AddData();
            $this->session->set_flashdata('add', 'Pencatatan level berhasil ditambahkan!');
            redirect('catatanlevel/index');
        }
    }

    public function edit()
    {
        $this->Catatanlevel_model->EditData();
        $this->session->set_flashdata('edit', 'Pencatatan level berhasil diubah!');
        redirect('catatanlevel');
    }

    public function delete($id_catatan_level)
    {
        $this->Catatanlevel_model->DeleteData($id_catatan_level);
        $this->session->set_flashdata('delete', 'Pencatatan level berhasil dihapus!');
        redirect('catatanlevel');
    }
}
