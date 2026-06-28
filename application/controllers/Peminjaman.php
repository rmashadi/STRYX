<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Peminjaman_model');
        $this->load->model('Aset_model');
        is_logged_in();
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Aset_model->users();
        $data['title'] = 'Peminjaman Aset';
        $data['peminjaman'] = $this->Peminjaman_model->getAll();
        $data['aset'] = $this->Aset_model->getAsetByUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/peminjaman/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $id_aset = htmlspecialchars($this->input->post('id_aset',TRUE));
        $tgl_mulai = htmlspecialchars($this->input->post('tgl_mulai',TRUE));
        $tgl_selesai = htmlspecialchars($this->input->post('tgl_selesai',TRUE));

        $spare_waktu = $this->Aset_model->getWaktuAset($id_aset)['spare_waktu'];
        $tgl_selesai = date('Y-m-d H:i:s', strtotime($tgl_selesai . ' +'.$spare_waktu.' minutes'));

        // Cek ketersediaan aset
        $available = $this->Peminjaman_model->checkAvailability($id_aset, $tgl_mulai, $tgl_selesai);

        if ($available == 0) {
            $data = [
                'id_aset' => $id_aset,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_peminjam' => htmlspecialchars($this->input->post('nama_peminjam',TRUE)),
                'instansi' => htmlspecialchars($this->input->post('instansi',TRUE)),
                'acara' => htmlspecialchars($this->input->post('acara',TRUE)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp',TRUE)),
                'ket' => htmlspecialchars($this->input->post('ket',TRUE)),
                'id_user'=> $this->session->userdata('id_user')
            ];

            $this->Peminjaman_model->addPeminjaman($data);
            $this->session->set_flashdata('success', 'Peminjaman berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Peminjaman gagal. Jadwal sudah terisi.');
        }

        redirect('peminjaman');
    }

    // Function to edit peminjaman
    public function edit($id_peminjaman) {
        $data['title'] = 'Edit Peminjaman Aset';
        $data['peminjaman'] = $this->Peminjaman_model->get_peminjaman_by_id($id_peminjaman);

        // cek apakah data yang mau edit adalah betul2 role nya peminjam?
        if(($this->session->userdata('role_id')) != '1' &&  ($this->session->userdata('role_id')) != '12' &&  ($this->session->userdata('id_user')) != $data['peminjaman']['id_user']) {
            $this->session->set_flashdata('error', 'Yang anda edit bukan data anda, cek kembali data anda');
            redirect('peminjaman');
        } else {
            $data['aset'] = $this->db->get('tb_aset')->result_array();

            $this->form_validation->set_rules('id_aset', 'Aset', 'required');
            // Add other form validation rules

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('peminjaman/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $id_aset = htmlspecialchars($this->input->post('id_aset',TRUE));

                $tgl_selesai = htmlspecialchars($this->input->post('tgl_selesai',TRUE));
                $spare_waktu = $this->Aset_model->getWaktuAset($id_aset)['spare_waktu'];
                $tgl_selesai = date('Y-m-d H:i:s', strtotime($tgl_selesai . ' +'.$spare_waktu.' minutes'));

                $this->Peminjaman_model->update_peminjaman($id_peminjaman, [
                    'id_aset' => $id_aset,
                    'tgl_mulai' => htmlspecialchars($this->input->post('tgl_mulai',TRUE)),
                    'tgl_selesai' => $tgl_selesai,
                    'nama_peminjam' => htmlspecialchars($this->input->post('nama_peminjam',TRUE)),
                    'instansi' => htmlspecialchars($this->input->post('instansi',TRUE)),
                    'acara' => htmlspecialchars($this->input->post('acara',TRUE)),
                    'no_hp' => htmlspecialchars($this->input->post('no_hp',TRUE)),
                    'ket' => htmlspecialchars($this->input->post('ket',TRUE))
                ]);
                $this->session->set_flashdata('success', 'Peminjaman berhasil diupdate!');
                redirect('peminjaman');
            }
        }
        //end cek
    }

    // Function to delete peminjaman
    public function delete($id_peminjaman) {
        $data['peminjaman'] = $this->Peminjaman_model->get_peminjaman_by_id($id_peminjaman);

        // cek apakah data yang mau edit adalah betul2 role nya peminjam?
        if(($this->session->userdata('role_id')) != '1' &&  ($this->session->userdata('role_id')) != '12' &&  ($this->session->userdata('id_user')) != $data['peminjaman']['id_user']) {
            $this->session->set_flashdata('error', 'Yang anda hapus bukan data anda, cek kembali data anda');
            redirect('peminjaman');
        } else {
            $this->Peminjaman_model->delete_peminjaman($id_peminjaman);
            $this->session->set_flashdata('message', 'Peminjaman berhasil dihapus!');
            redirect('peminjaman');
        }
        
    }

    public function checkAvailabilitylist()
    {
        //load data untuk peminjaman
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Aset_model->users();
        $data['title'] = 'Peminjaman Aset';
        $data['peminjaman'] = $this->Peminjaman_model->getAll();
        $data['aset'] = $this->Aset_model->getAsetByUser();
        //end

        // Ambil input dan filter
        $id_aset = htmlspecialchars($this->input->post('id_aset',TRUE));
        $tgl_mulai = htmlspecialchars($this->input->post('tgl_mulai',TRUE));
        $tgl_selesai = htmlspecialchars($this->input->post('tgl_selesai',TRUE));

        $data['tersediapeminjaman'] = $this->Peminjaman_model->checkAvailabilityDetail($id_aset, $tgl_mulai, $tgl_selesai);
        // print_r($data['tersediapeminjaman']); exit;

        //ambil template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/peminjaman/index', $data);
        $this->load->view('templates/footer');
    }

}
?>
