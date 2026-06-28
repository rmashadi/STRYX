<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Role_model','Menu_model']);
        is_logged_in();
    }

    public function index()
    {
        $data['user']   = $this->User_model->users();
        $data['title']  = 'User Management';
        $data['users']  = $this->User_model->getAll($data['user']['role_id']);
        $data['role']   = $this->Role_model->getAll($data['user']['role_id']);

        $url = $this->uri->segment(1); // Mengambil segmen pertama dari URL
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('management/user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->User_model->AddData();
            $this->session->set_flashdata('add', 'Tambahkan');
            redirect('user/index');
        }
    }

    public function Edit()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[0-9]).*$/]', [
            'min_length' => 'Password minimal 8 karakter',
            'regex_match' => 'Password harus mengandung setidaknya satu huruf besar dan satu angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('user_id', $this->input->post('id_user'));
            redirect('user');
        } else {
            $this->User_model->EditData();
            $this->session->set_flashdata('edit', 'Ubah');
            redirect('user');
        }
    }



    // public function Edit()
    // {
    //     $this->User_model->EditData();
    //     $this->session->set_flashdata('edit', 'Ubah');
    //     redirect('user');
    // }

    // public function Delete($id)
    // {
    //     $this->User_model->DeleteData($id);
    //     $this->session->set_flashdata('delete', 'Hapus');
    //     redirect('user');
    // }
}
