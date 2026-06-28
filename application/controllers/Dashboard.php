<?php
// defined('BASEPATH') or exit('No direct script access allowed');

// class Dashboard extends CI_Controller
// {
//     public function __construct()
//     {
//         parent::__construct();
//         is_logged_in();
//     }

//     public function index()
//     {
//         $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
//         $data['title'] = 'Dashboard';
//         $this->load->view('templates/header', $data);
//         $this->load->view('templates/sidebar', $data);
//         $this->load->view('templates/topbar', $data);
//         $this->load->view('dashboard/index', $data);
//         $this->load->view('templates/footer');
//     }
// }

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
        $this->load->model('Dashboard_model'); // Buat model Dashboard_model
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Ambil data rangkuman
        $data['total_pending'] = $this->Dashboard_model->get_total_pending();
        $data['total_users'] = $this->Dashboard_model->get_total_users();
        $data['total_aset'] = $this->Dashboard_model->get_total_aset();
        $data['total_peminjaman'] = $this->Dashboard_model->get_total_peminjaman();
        $data['total_peminjaman_hariini'] = $this->Dashboard_model->total_peminjaman_hariini();
        $data['top_aset'] = $this->Dashboard_model->get_top_aset();
        $data['kondisi_aset'] = $this->Dashboard_model->get_kondisi_aset();

        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}

