<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatansiber extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Catatansiber_model');
        is_logged_in(); // Sesuaikan dengan method otentikasi Anda
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Catatansiber_model->users();
        $data['title'] = 'Pencatatan Insiden Siber Management';
        $data['catatansiber'] = $this->Catatansiber_model->getAll();
        $data['levelinsiden'] = $this->Catatansiber_model->getCategories(); // Ambil data level insiden
        $data['jenisinsiden'] = $this->Catatansiber_model->getJenisinsiden(); // Ambil data jenis insiden
        $data['domain'] = $this->Catatansiber_model->getDomain(); // Ambil data level insiden
        $data['statusrecovery'] = $this->Catatansiber_model->getStatusRecovery(); // Ambil data status recovery
        
        $this->form_validation->set_rules('tanggal_pelaporan', 'tanggal pelaporan', 'required');
        $this->form_validation->set_rules('penerima_laporan', 'penerima laporan', 'required');
        $this->form_validation->set_rules('nama_pelapor', 'nama pelapor', 'required');
        $this->form_validation->set_rules('tanggal_insiden', 'tanggal insiden', 'required');
        $this->form_validation->set_rules('id_domain', 'domain', 'required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
        $this->form_validation->set_rules('analisis_penyebab', 'analisis penyebab', 'required');
        $this->form_validation->set_rules('dampak_insiden', 'dampak', 'required');
        $this->form_validation->set_rules('id_jenis_insiden', 'jenis insiden', 'required');
        $this->form_validation->set_rules('id_level_insiden', 'level insiden', 'required');
        $this->form_validation->set_rules('tindakan_koreksi', 'tindakan koreksi', 'required');
        $this->form_validation->set_rules('tanggal_pengendalian', 'tanggal pengendalian', 'required');
        $this->form_validation->set_rules('root_cause', 'root cause', 'required');
        $this->form_validation->set_rules('tindakan_korektif', 'tindakan korektif', 'required');
        $this->form_validation->set_rules('tanggal_selesai_korektif', 'tanggal selesai korektif', 'required');
        $this->form_validation->set_rules('nama_pic_perbaikan', 'nama pic', 'required');
        $this->form_validation->set_rules('id_status_recovery', 'status recovery', 'required');
        $this->form_validation->set_rules('lesson_learned', 'lesson learned', 'required');
        $this->form_validation->set_rules('catatan', 'catatan', 'required');

        // $this->form_validation->set_rules('kd_aset', 'Kode Aset', 'required');
        // $this->form_validation->set_rules('nama', 'Nama Aset', 'required');
        // $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        // $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        // $this->form_validation->set_rules('id_kondisi', 'Kondisi Aset', 'required');
        // $this->form_validation->set_rules('is_aktif', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('insidensiber/catatansiber/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Catatansiber_model->AddData();
            $this->session->set_flashdata('add', 'Ditambahkan');
            redirect('catatansiber');
        }
    }

    public function edit()
    {
        
        $this->Catatansiber_model->EditData();
        $this->session->set_flashdata('edit', 'Diubah');
        redirect('catatansiber');
    }

    public function delete($id_insiden_siber)
    {
        $this->Catatansiber_model->DeleteData($id_insiden_siber);
        $this->session->set_flashdata('delete', 'Dihapus');
        redirect('catatansiber');
    }
}
