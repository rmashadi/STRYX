<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Surat_model');
        $this->load->model('Peminjaman_model');
    }

    public function index() {
        $kode_instansi = $this->input->get('kode_instansi');
        $tahun = $this->input->get('tahun');
        $key = $this->input->get('key');

        $data['surat'] = $this->Surat_model->get_surat_filtered($kode_instansi,$tahun,$key);
        $data['listinstansi'] = $this->Peminjaman_model->get_instansi();
        // print_r($data['surat']); exit();
        $this->load->view('surat/public_surat', $data);
    }

    public function get_timeline()
    {  
        $no_surat = $this->input->post('no_surat');
        $timeline = $this->Surat_model->get_surat_detail_filtered($no_surat); 
        echo json_encode($timeline);
    }  
}
