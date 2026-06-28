<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatanjenis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Catatanjenis_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Catatanjenis_model->users();
        $data['title'] = 'Pencatatan Jenis Management';
        $data['catatanjenis'] = $this->Catatanjenis_model->getAll();
        $data['jenisserangan'] = $this->Catatanjenis_model->getJenisserangan(); // Ambil data instansi
        
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jenis_serangan_1', 'jenis serangan 1', 'required');
        $this->form_validation->set_rules('jumlah_1', 'jumlah 1', 'required');
        $this->form_validation->set_rules('jenis_serangan_2', 'jenis serangan 2', 'required');
        $this->form_validation->set_rules('jumlah_2', 'jumlah 2', 'required');
        $this->form_validation->set_rules('jenis_serangan_3', 'jenis serangan 3', 'required');
        $this->form_validation->set_rules('jumlah_3', 'jumlah 3', 'required');
        $this->form_validation->set_rules('jenis_serangan_4', 'jenis serangan 4', 'required');
        $this->form_validation->set_rules('jumlah_4', 'jumlah 4', 'required');
        $this->form_validation->set_rules('jenis_serangan_5', 'jenis serangan 5', 'required');
        $this->form_validation->set_rules('jumlah_5', 'jumlah 5', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('percobaanserangan/catatanjenis/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Catatanjenis_model->AddData();
            $this->session->set_flashdata('add', 'Pencatatan level berhasil ditambahkan!');
            redirect('catatanjenis/index');
        }
    }

    public function edit()
    {
        $this->Catatanjenis_model->EditData();
        $this->session->set_flashdata('edit', 'Pencatatan level berhasil diubah!');
        redirect('catatanjenis');
    }

    public function delete($id_catatan_level)
    {
        $this->Catatanjenis_model->DeleteData($id_catatan_level);
        $this->session->set_flashdata('delete', 'Pencatatan level berhasil dihapus!');
        redirect('catatanjenis');
    }
}
