<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Useraset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('UserAset_model');
        $this->load->model('Aset_model');
        $this->load->model('User_model');
        is_logged_in();
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['title'] = 'Manage Otoritas User by Aset';
        $data['user'] = $this->Aset_model->users();
        $data['users'] = $this->User_model->getAllUsers($data['user']['role_id']);
        
        $data['selectedUser'] = null;
        $data['availableAset'] = [];
        $data['selectedAset'] = [];

        if ($this->input->post('user_id')) {
            $data['selectedUser'] = $this->input->post('user_id');
            $data['availableAset'] = $this->UserAset_model->getAvailableAset($data['selectedUser']);
            $data['selectedAset'] = $this->UserAset_model->getSelectedAset($data['selectedUser']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/useraset/index', $data);
        $this->load->view('templates/footer');
    }

    public function updateAset()
    {
        $user_id = $this->input->post('user_id');
        $selected_aset = $this->input->post('selected_aset');

        // Perbarui data user_has_aset berdasarkan input dari user
        $this->UserAset_model->updateUserAset($user_id, $selected_aset);

        $this->session->set_flashdata('message', 'Otoritas Aset berhasil diperbarui!');
        redirect('useraset');
    }

    public function getAsetByUser()
    {
        $user_id = $this->input->post('user_id');
        $availableAset = $this->UserAset_model->getAvailableAset($user_id);
        $selectedAset = $this->UserAset_model->getSelectedAset($user_id);

        // Kirimkan hasil sebagai JSON
        echo json_encode([
            'availableAset' => $availableAset,
            'selectedAset' => $selectedAset
        ]);
    }
}




?>
