<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Pengembalian_model');
        $this->load->model('Aset_model');
        is_logged_in();
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Aset_model->users();
        $data['title'] = 'Pengembalian Aset';
        $data['peminjaman'] = $this->Pengembalian_model->getAll();
        $data['kondisi'] = $this->Aset_model->getKondisi();
        $data['aset'] = $this->Aset_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/pengembalian/index', $data);
        $this->load->view('templates/footer');
    }

    // Function to edit Pengembalian
    public function edit($id_peminjaman) {
        $data['title'] = 'Edit List Peminjaman Aset';
        $data['peminjaman'] = $this->Pengembalian_model->get_peminjaman_by_id($id_peminjaman);
        $data['aset'] = $this->db->get('tb_aset')->result_array();

        $this->form_validation->set_rules('id_aset', 'Aset', 'required');
        // Add other form validation rules

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pengembalian/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Pengembalian_model->update_peminjaman($id_peminjaman, [
                'status' => $this->input->post('status')
            ]);
            $this->session->set_flashdata('message', 'Pengembalian berhasil diupdate!');
            redirect('pengembalian');
        }
    }

}
?>
