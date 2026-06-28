<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambahagenda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Tambahagenda_model');
        is_logged_in(); // mengecek akses user
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $tanggal        = htmlspecialchars($this->input->post('tanggal', true));
        $data['menus']  = $this->Menu_model->getMenuByUrl($url);
        $data['user']   = $this->Tambahagenda_model->users();
        $data['title']  = 'Tambah Agenda Kegiatan';

        // Jika ada parameter filter yang diisi, gunakan filter tersebut.
        if ($tanggal) {
            $data['agenda'] = $this->Tambahagenda_model->getFiltered($tanggal);
            $this->form_validation->set_rules('tambahagenda', 'Tambahagenda', 'required');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('agenda/tambahagenda/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika tidak ada parameter yang diisi, tampilkan semua data.
            $data['agenda'] = $this->Tambahagenda_model->getAll();
            $this->form_validation->set_rules('tambahagenda', 'Tambahagenda', 'required');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('agenda/tambahagenda/index', $data);
            $this->load->view('templates/footer');
        }


        // $data['agenda'] = $this->Tambahagenda_model->getAll();
        // $this->form_validation->set_rules('tambahagenda', 'Tambahagenda', 'required');

        // if ($this->form_validation->run() == FALSE) {
            // $this->load->view('templates/header', $data);
            // $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            // $this->load->view('agenda/tambahagenda/index', $data);
            // $this->load->view('templates/footer');
        // } else {
        //     $this->Tambahagenda_model->AddData();
        //     $this->session->set_flashdata('add', 'Kondisi berhasil ditambahkan!');
        //     redirect('tambahagenda/index');
        // }
    }

    public function addagenda()
    {
        // print_r("Masuk sini"); exit();
        $msg = $this->Tambahagenda_model->AddData();
        $this->session->set_flashdata('add', $msg);
        redirect('tambahagenda');
    }

    public function edit()
    {
        $this->Tambahagenda_model->EditData();
        $this->session->set_flashdata('edit', 'Kondisi berhasil diubah!');
        redirect('tambahagenda');
    }

    public function delete($id_kondisi)
    {
        // $this->Tambahagenda_model->DeleteData($id_kondisi);
        // $this->session->set_flashdata('delete', 'Kondisi berhasil dihapus!');
        $this->session->set_flashdata('delete', 'Gagal Menghapus Data');
        redirect('tambahagenda');
    }
}
