<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Peminjaman_model');
    }

    public function index() {
        // $encoded_id_aset = $this->input->get('id_aset');
        // $encoded_tanggal = $this->input->get('tanggal');

        // $id_aset = $encoded_id_aset ? base64_decode($encoded_id_aset) : '';
        // $tanggal = $encoded_tanggal ? base64_decode($encoded_tanggal) : '';

        $data['agenda'] = $this->Peminjaman_model->get_agenda_filtered();
        // $data['ruangan'] = $this->Peminjaman_model->get_ruangan();
        // $data['selected_ruang'] = $id_aset; 
        // $data['selected_tanggal'] = $tanggal; 
        $this->load->view('public_agenda', $data);
    }
}
