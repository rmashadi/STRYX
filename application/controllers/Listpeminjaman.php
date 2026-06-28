<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listpeminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Listpeminjaman_model');
        $this->load->model('Aset_model');
        is_logged_in();
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Aset_model->users();
        $data['title'] = 'Approve Peminjaman Aset';
        $data['peminjaman'] = $this->Listpeminjaman_model->getAll();
        $data['aset'] = $this->Aset_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/listpeminjaman/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $id_aset = $this->input->post('id_aset');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');

        // Cek ketersediaan aset
        $available = $this->Listpeminjaman_model->checkAvailability($id_aset, $tgl_mulai, $tgl_selesai);

        if ($available == 0) {
            $data = [
                'ket' => $this->input->post('ket')
            ];

            $this->Listpeminjaman_model->addPeminjaman($data);
            $this->session->set_flashdata('success', 'Peminjaman berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Peminjaman gagal. Jadwal sudah terisi.');
        }

        redirect('peminjaman');
    }

    // Function to edit peminjaman
    public function edit($id_peminjaman) {
        $data['title'] = 'Edit List Peminjaman Aset';
        $data['peminjaman'] = $this->Listpeminjaman_model->get_peminjaman_by_id($id_peminjaman);
        $data['aset'] = $this->db->get('tb_aset')->result_array();

        $this->form_validation->set_rules('id_aset', 'Aset', 'required');
        // Add other form validation rules

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('listpeminjaman/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Listpeminjaman_model->update_peminjaman($id_peminjaman, [
                'status' => $this->input->post('status')
            ]);
            $this->session->set_flashdata('message', 'Peminjaman berhasil diupdate!');
            redirect('listpeminjaman');
        }
    }

    // Function to delete peminjaman
    public function delete($id_peminjaman) {
        $this->Peminjaman_model->delete_peminjaman($id_peminjaman);
        $this->session->set_flashdata('message', 'Peminjaman berhasil dihapus!');
        redirect('peminjaman');
    }
}
?>
