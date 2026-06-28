<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registerlist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Registerlist_model');
        is_logged_in();
    }

    public function index()
    {
        $data['user']   = $this->Registerlist_model->users();
        $data['title'] = 'Approve User';
        $data['register'] = $this->Registerlist_model->getAll();

        $url = $this->uri->segment(1); // Mengambil segmen pertama dari URL
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('management/register/index', $data);
        $this->load->view('templates/footer');
    }

    public function approve($id_user)
    {
        // Ambil data user dari tabel register berdasarkan id_user
        $user = $this->db->get_where('register', ['id_user' => $id_user])->row_array();

        if ($user) {
            // Persiapkan data untuk dimasukkan ke tabel user
            $data = [
                'name'      => $user['name'],
                'username'  => $user['username'],
                'email'     => $user['email'],
                'no_hp'     => $user['no_hp'],
                'instansi'  => $user['instansi'],
                'image'     => $user['image'],
                'password'  => $user['password'],
                'role_id'   => $user['role_id'],
                'is_active' => 1, // Aktifkan user di tabel user
                'date_created' => $user['date_created']
            ];

            // Masukkan data ke tabel user
            $this->db->insert('user', $data);

            // Update status is_active di tabel register menjadi 1 (Sudah disetujui)
            $this->db->set('is_active', 1);
            $this->db->where('id_user', $id_user);
            $this->db->update('register');

            // Set flashdata untuk notifikasi
            $this->session->set_flashdata('success', 'User berhasil disetujui.');

            redirect('registerlist');
        } else {
            // Set flashdata jika user tidak ditemukan
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('registerlist');
        }
    }


}
?>
