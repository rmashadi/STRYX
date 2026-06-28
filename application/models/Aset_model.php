<?php defined('BASEPATH') or exit('No direct script access allowed');

class Aset_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getUsers() {
        
        return $this->db->get('user')->result_array(); // Asumsi tabel user bernama 'users'
    }

    public function getAll()
    {
        // return $this->db->get('tb_aset')->result_array();
        $this->db->select('tb_kategori.id_kategori,tb_kategori.kategori,tb_aset.*');
        $this->db->from('tb_aset');
        $this->db->join('tb_kategori', 'tb_aset.id_kategori = tb_kategori.id_kategori');
        return $this->db->get()->result_array();
    }

    public function getAsetByUser()
    {
        $id_user = $this->session->userdata('id_user');

        $this->db->select('tb_kategori.id_kategori, tb_kategori.kategori, tb_aset.*');
        $this->db->from('tb_aset');
        $this->db->join('tb_kategori', 'tb_aset.id_kategori = tb_kategori.id_kategori');

        $subquery = "(SELECT id_aset FROM user_has_aset WHERE user_id = $id_user)";
        
        $this->db->where("tb_aset.id_aset IN $subquery");
        $this->db->order_by('tb_aset.nama', 'ASC');

        return $this->db->get()->result_array();
    }


    public function AddData()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 120480; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            // Jika upload gagal, tampilkan pesan error
            $error = array('error' => $this->upload->display_errors());
            // Tampilkan error pada view
        }

        // Jika upload berhasil
        $fileData = $this->upload->data();
        $data = [
            "kd_aset" => htmlspecialchars($this->input->post('kd_aset', true)),
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "deskripsi" => htmlspecialchars($this->input->post('deskripsi', true)),
            "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
            "foto" => $fileData['file_name'],
            "kapasitas" => htmlspecialchars($this->input->post('kapasitas', true)),
            "cp_pengampu" => htmlspecialchars($this->input->post('cp_pengampu', true)),
            "spare_waktu" => htmlspecialchars($this->input->post('spare_waktu', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
            "lokasi" => htmlspecialchars($this->input->post('lokasi', true)),
            "id_kondisi" => htmlspecialchars($this->input->post('id_kondisi', true)),
            "is_aktif" => htmlspecialchars($this->input->post('is_aktif', true))
        ];

        $this->db->insert('tb_aset', $data);
    }

    public function EditData()
    {
        $id_aset = htmlspecialchars($this->input->post('id_aset', true));

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 120480;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $fileData = $this->upload->data();
            $foto = $fileData['file_name'];
        } else {
            $foto = htmlspecialchars($this->input->post('foto_lama', true)); // Set foto ke foto lama jika tidak ada file baru
        }

        if ($this->upload->do_upload('foto2')) {
            $fileData = $this->upload->data();
            $foto2 = $fileData['file_name'];
        } else {
            $foto2 = htmlspecialchars($this->input->post('foto2_lama', true)); // Set foto ke foto lama jika tidak ada file baru
        }

        if ($this->upload->do_upload('foto3')) {
            $fileData = $this->upload->data();
            $foto3 = $fileData['file_name'];
        } else {
            $foto3 = htmlspecialchars($this->input->post('foto3_lama', true)); // Set foto ke foto lama jika tidak ada file baru
        }

        if ($this->upload->do_upload('foto4')) {
            $fileData = $this->upload->data();
            $foto4 = $fileData['file_name'];
        } else {
            $foto4 = htmlspecialchars($this->input->post('foto4_lama', true)); // Set foto ke foto lama jika tidak ada file baru
        }

        $data = [
            "kd_aset" => htmlspecialchars($this->input->post('kd_aset', true)),
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "deskripsi" => htmlspecialchars($this->input->post('deskripsi', true)),
            "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
            "foto" => $foto,
            "foto2" => $foto2,
            "foto3" => $foto3,
            "foto4" => $foto4,
            "kapasitas" => htmlspecialchars($this->input->post('kapasitas', true)),
            "cp_pengampu" => htmlspecialchars($this->input->post('cp_pengampu', true)),
            "spare_waktu" => htmlspecialchars($this->input->post('spare_waktu', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
            "lokasi" => htmlspecialchars($this->input->post('lokasi', true)),
            "id_kondisi" => htmlspecialchars($this->input->post('id_kondisi', true)),
            "is_aktif" => htmlspecialchars($this->input->post('is_aktif', true))
        ];

        $this->db->where('id_aset', $id_aset);
        $this->db->update('tb_aset', $data);
    }

    public function getById($id_aset)
    {
        return $this->db->get_where('tb_aset', ['id_aset' => $id_aset])->row_array();
    }

    public function getWaktuAset($id_aset)
    {
        $this->db->select('spare_waktu');
        return $this->db->get_where('tb_aset', ['id_aset' => $id_aset])->row_array();
    }

    public function DeleteData($id_aset)
    {
        $this->db->delete('tb_aset', ['id_aset' => $id_aset]);
    }

    public function getCategories()
    {
        return $this->db->get('tb_kategori')->result_array();
    }

    public function getKondisi()
    {
        return $this->db->get('tb_kondisi')->result_array();
    }

}
