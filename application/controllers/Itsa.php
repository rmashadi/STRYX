<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Itsa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Itsa_model');
        $this->load->model('Instansi_model');
        $this->load->library('form_validation');
        is_logged_in(); // pastikan metode auth Anda
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        $data['user'] = $this->Itsa_model->users();
        $data['title'] = "Data Permohonan ITSA";
        $data['itsa'] = $this->Itsa_model->getAll();
        $data['level_rentan'] = $this->Itsa_model->getAllLevelRentan();
        $data['instansi'] = $this->Instansi_model->getAll();

        // Tambahkan kerentanan per layanan
        foreach ($data['itsa'] as &$item) {
            $item['kerentanan'] = $this->Itsa_model->getByLayanan($item['id_layanan']);
        }

        // Tambahkan Perbaikan ITSA
        foreach ($data['itsa'] as &$item) {
            $item['perbaikan'] = $this->Itsa_model->getPerbaikanByLayanan($item['id_layanan']);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('itsa/permohonanitsa/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->_validateForm();

        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $upload_notulen = $this->_uploadFile('doc_notulen');
        $upload_laporan = $this->_uploadFile('doc_laporan_itsa');

        $data = $this->input->post();
        $data['doc_notulen'] = $upload_notulen;
        $data['doc_laporan_itsa'] = $upload_laporan;

        

        $this->Itsa_model->insert($data);
        $this->session->set_flashdata('add', 'Data berhasil ditambahkan!');
        redirect('itsa');
    }

    public function edit()
    {
        $this->_validateForm();

        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $id = $this->input->post('id_layanan');
        $lama_notulen = $this->input->post('doc_notulen_lama');
        $lama_laporan = $this->input->post('doc_laporan_itsa_lama');

        $notulen = $this->_uploadFile('doc_notulen', $lama_notulen);
        $laporan = $this->_uploadFile('doc_laporan_itsa', $lama_laporan);

        $post = $this->input->post();
        unset($post['doc_notulen_lama'], $post['doc_laporan_itsa_lama']);

        $post['doc_notulen'] = $notulen;
        $post['doc_laporan_itsa'] = $laporan;

        $this->Itsa_model->update($id, $post);
        $this->session->set_flashdata('edit', 'Data berhasil diperbarui!');
        redirect('itsa');
    }

    public function hapus($id)
    {
        $data = $this->Itsa_model->getById($id);

        if ($data) {
            @unlink('./uploads/' . $data['doc_notulen']);
            @unlink('./uploads/' . $data['doc_laporan_itsa']);
        }

        $this->Itsa_model->delete($id);
        $this->session->set_flashdata('delete', 'Data berhasil dihapus!');
        redirect('itsa');
    }

    public function hapusperbaikan($id)
    {
        // $data = $this->Itsa_model->getById($id);

        // if ($data) {
        //     @unlink('./uploads/' . $data['doc_notulen']);
        //     @unlink('./uploads/' . $data['doc_laporan_itsa']);
        // }

        $this->Itsa_model->deleteperbaikan($id);
        $this->session->set_flashdata('delete', 'Data berhasil dihapus!');
        redirect('itsa');
    }

    public function hapuslistkerentanan($id)
    {
        $this->Itsa_model->deletekerentanan($id);
        $this->session->set_flashdata('delete', 'Data berhasil dihapus!');
        redirect('itsa');
    }

    private function _validateForm()
    {
        $this->form_validation->set_rules('no_surat', 'No Surat', 'required');
        $this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'required');
        $this->form_validation->set_rules('tgl_surat_terima', 'Tanggal Terima', 'required');
        $this->form_validation->set_rules('id_instansi', 'Instansi', 'required');
        // $this->form_validation->set_rules('perihal', 'Perihal', 'required');
        // $this->form_validation->set_rules('kesiapan_itsa', 'Kesiapan', 'required');
    }

    private function _uploadFile($field_name, $old_file = null)
    {
        $file = $_FILES[$field_name]['name'];
        if ($file) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf|doc|docx|gif|jpg|png|jpeg';
            $config['file_name'] = time() . '_' . $file;
            $config['overwrite'] = true;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload($field_name)) {
                if ($old_file && file_exists($config['upload_path'] . $old_file)) {
                    unlink($config['upload_path'] . $old_file);
                }
                return $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                redirect('itsa');
                exit;
            }
        }
        return $old_file;
    }

    public function tambah_kerentanan()
    {
        // Validasi form input
        $this->form_validation->set_rules('id_layanan', 'ID Layanan', 'required');
        $this->form_validation->set_rules('id_level_rentan', 'Level Kerentanan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('add_error', 'Gagal menambahkan kerentanan. Pastikan semua data terisi.');
            redirect('itsa');
        }

        $data = [
            'id_layanan' => $this->input->post('id_layanan'),
            'id_level_rentan' => $this->input->post('id_level_rentan'),
            'jumlah' => $this->input->post('jumlah')
        ];

        $this->Itsa_model->insertKerentanan($data);

        $this->session->set_flashdata('add', 'Kerentanan berhasil ditambahkan!');
        redirect('itsa');
    }

    public function addPerbaikan()
    {
        $id_layanan = $this->input->post('id_layanan');

        $data = [
            'id_layanan' => $id_layanan,
            'no_surat_perbaikan' => $this->input->post('no_surat_perbaikan'),
            'tgl_surat_perbaikan' => $this->input->post('tgl_surat_perbaikan'),
            'pelaksanaan_verifikasi' => $this->input->post('pelaksanaan_verifikasi'),
            'no_surat_verifikasi' => $this->input->post('no_surat_verifikasi'),
            'tgl_surat_verifikasi' => $this->input->post('tgl_surat_verifikasi'),
            'doc_perbaikan' => $this->_uploadFileCustom('doc_perbaikan'),
            'doc_verifikasi' => $this->_uploadFileCustom('doc_verifikasi')
        ];

        $this->Itsa_model->insertPerbaikan($data);
        $this->session->set_flashdata('add', 'Perbaikan berhasil ditambahkan.');
        redirect('itsa');
    }

    private function _uploadFileCustom($field_name)
    {
        $file = $_FILES[$field_name]['name'];
        if ($file) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf|doc|docx|gif|jpg|png|jpeg';
            $config['file_name'] = time() . '_' . $file;
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            if ($this->upload->do_upload($field_name)) {
                return $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                redirect('itsa');
                exit;
            }
        }
        return null;
    }



}
