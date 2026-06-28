<?php defined('BASEPATH') or exit('No direct script access allowed');

class Catatansiber_model extends CI_Model
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
        $this->db->select('skpd.instansi, dom.nama_aplikasi, jie.id_jenis_insiden, jie.jenis_insiden, sr.id_status_recovery, sr.status_recovery, li.id_level_insiden,li.level_insiden,tb_insiden_siber.*');
        $this->db->from('tb_insiden_siber');
        $this->db->join('tb_level_insiden AS li', 'tb_insiden_siber.id_level_insiden = li.id_level_insiden');
        $this->db->join('tb_status_recovery AS sr', 'tb_insiden_siber.id_status_recovery = sr.id_status_recovery');
        $this->db->join('tb_jenis_insiden AS jie', 'tb_insiden_siber.id_jenis_insiden = jie.id_jenis_insiden');
        $this->db->join('tb_domain AS dom', 'tb_insiden_siber.id_domain = dom.id_domain');
        $this->db->join('tb_instansi AS skpd', 'dom.id_instansi = skpd.id_instansi');
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

            "tanggal_pelaporan" => htmlspecialchars($this->input->post('tanggal_pelaporan', true)),
            "penerima_laporan" => htmlspecialchars($this->input->post('penerima_laporan', true)),
            "nama_pelapor" => htmlspecialchars($this->input->post('nama_pelapor', true)),
            "tanggal_insiden" => htmlspecialchars($this->input->post('tanggal_insiden', true)),
            "id_domain" => htmlspecialchars($this->input->post('id_domain', true)),
            "deskripsi" => htmlspecialchars($this->input->post('deskripsi', true)),
            "analisis_penyebab" => htmlspecialchars($this->input->post('analisis_penyebab', true)),
            "dampak_insiden" => htmlspecialchars($this->input->post('dampak_insiden', true)),
            "upload_bukti" => $fileData['file_name'],
            "id_jenis_insiden" => htmlspecialchars($this->input->post('id_jenis_insiden', true)),
            "id_level_insiden" => htmlspecialchars($this->input->post('id_level_insiden', true)),
            "tindakan_koreksi" => htmlspecialchars($this->input->post('tindakan_koreksi', true)),
            "tanggal_pengendalian" => htmlspecialchars($this->input->post('tanggal_pengendalian', true)),
            "root_cause" => htmlspecialchars($this->input->post('root_cause', true)),
            "tindakan_korektif" => htmlspecialchars($this->input->post('tindakan_korektif', true)),
            "tanggal_selesai_korektif" => htmlspecialchars($this->input->post('tanggal_selesai_korektif', true)),
            "nama_pic_perbaikan" => htmlspecialchars($this->input->post('nama_pic_perbaikan', true)),
            "id_status_recovery" => htmlspecialchars($this->input->post('id_status_recovery', true)),
            "lesson_learned" => htmlspecialchars($this->input->post('lesson_learned', true)),
            "catatan" => htmlspecialchars($this->input->post('catatan', true)),
            "user_input" => $this->session->userdata('name'),
            "tgl_input" => (date('Y-m-d H:i:s')),

            // "kd_aset" => htmlspecialchars($this->input->post('kd_aset', true)),
            // "nama" => htmlspecialchars($this->input->post('nama', true)),
            // "deskripsi" => htmlspecialchars($this->input->post('deskripsi', true)),
            // "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
            // "foto" => $fileData['file_name'],
            // "kapasitas" => htmlspecialchars($this->input->post('kapasitas', true)),
            // "cp_pengampu" => htmlspecialchars($this->input->post('cp_pengampu', true)),
            // "spare_waktu" => htmlspecialchars($this->input->post('spare_waktu', true)),
            // "ket" => htmlspecialchars($this->input->post('ket', true)),
            // "lokasi" => htmlspecialchars($this->input->post('lokasi', true)),
            // "id_kondisi" => htmlspecialchars($this->input->post('id_kondisi', true)),
            // "is_aktif" => htmlspecialchars($this->input->post('is_aktif', true))
        ];

        $this->db->insert('tb_insiden_siber', $data);
    }

    public function EditData()
    {
        $id_insiden_siber = htmlspecialchars($this->input->post('id_insiden_siber', true));

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 120480;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('upload_bukti')) {
            $fileData = $this->upload->data();
            $foto = $fileData['file_name'];
        } else {
            $foto = htmlspecialchars($this->input->post('foto_lama', true)); // Set foto ke foto lama jika tidak ada file baru
        }

       
        $data = [

            "tanggal_pelaporan" => htmlspecialchars($this->input->post('tanggal_pelaporan', true)),
            "penerima_laporan" => htmlspecialchars($this->input->post('penerima_laporan', true)),
            "nama_pelapor" => htmlspecialchars($this->input->post('nama_pelapor', true)),
            "tanggal_insiden" => htmlspecialchars($this->input->post('tanggal_insiden', true)),
            "id_domain" => htmlspecialchars($this->input->post('id_domain', true)),
            "deskripsi" => htmlspecialchars($this->input->post('deskripsi', true)),
            "analisis_penyebab" => htmlspecialchars($this->input->post('analisis_penyebab', true)),
            "dampak_insiden" => htmlspecialchars($this->input->post('dampak_insiden', true)),
            "upload_bukti" => $foto,
            "id_jenis_insiden" => htmlspecialchars($this->input->post('id_jenis_insiden', true)),
            "id_level_insiden" => htmlspecialchars($this->input->post('id_level_insiden', true)),
            "tindakan_koreksi" => htmlspecialchars($this->input->post('tindakan_koreksi', true)),
            "tanggal_pengendalian" => htmlspecialchars($this->input->post('tanggal_pengendalian', true)),
            "root_cause" => htmlspecialchars($this->input->post('root_cause', true)),
            "tindakan_korektif" => htmlspecialchars($this->input->post('tindakan_korektif', true)),
            "tanggal_selesai_korektif" => htmlspecialchars($this->input->post('tanggal_selesai_korektif', true)),
            "nama_pic_perbaikan" => htmlspecialchars($this->input->post('nama_pic_perbaikan', true)),
            "id_status_recovery" => htmlspecialchars($this->input->post('id_status_recovery', true)),
            "lesson_learned" => htmlspecialchars($this->input->post('lesson_learned', true)),
            "catatan" => htmlspecialchars($this->input->post('catatan', true)),
            "user_input" => $this->session->userdata('name'),
            "tgl_input" => (date('Y-m-d H:i:s')),

            // "kd_aset" => htmlspecialchars($this->input->post('kd_aset', true)),
            // "nama" => htmlspecialchars($this->input->post('nama', true)),
            // "deskripsi" => htmlspecialchars($this->input->post('deskripsi', true)),
            // "id_kategori" => htmlspecialchars($this->input->post('id_kategori', true)),
            // "foto" => $foto,
            // "foto2" => $foto2,
            // "foto3" => $foto3,
            // "foto4" => $foto4,
            // "kapasitas" => htmlspecialchars($this->input->post('kapasitas', true)),
            // "cp_pengampu" => htmlspecialchars($this->input->post('cp_pengampu', true)),
            // "spare_waktu" => htmlspecialchars($this->input->post('spare_waktu', true)),
            // "ket" => htmlspecialchars($this->input->post('ket', true)),
            // "lokasi" => htmlspecialchars($this->input->post('lokasi', true)),
            // "id_kondisi" => htmlspecialchars($this->input->post('id_kondisi', true)),
            // "is_aktif" => htmlspecialchars($this->input->post('is_aktif', true))
        ];

        $this->db->where('id_insiden_siber', $id_insiden_siber);
        $this->db->update('tb_insiden_siber', $data);
    }

    public function getById($id_insiden_siber)
    {
        return $this->db->get_where('tb_insiden_siber', ['id_insiden_siber' => $id_insiden_siber])->row_array();
    }

    public function DeleteData($id_insiden_siber)
    {
        $this->db->delete('tb_insiden_siber', ['id_insiden_siber' => $id_insiden_siber]);
    }

    public function getCategories()
    {
        return $this->db->get('tb_level_insiden')->result_array();
    }

    public function getJenisinsiden()
    {
        return $this->db->get('tb_jenis_insiden')->result_array();
    }

     public function getDomain()
    {
        return $this->db->get('tb_domain')->result_array();
    }

    public function getStatusRecovery()
    {
        return $this->db->get('tb_status_recovery')->result_array();
    }

}
