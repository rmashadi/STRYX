<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        $id_user = $this->session->userdata('id_user');
        $role_id = $this->session->userdata('role_id');
        $this->db->select('tb_peminjaman.*, tb_aset.nama as nama_aset, tb_kondisi.kondisi as kondisi');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_peminjaman.id_aset = tb_aset.id_aset');
        $this->db->join('tb_kondisi', 'tb_peminjaman.id_kondisi = tb_kondisi.id_kondisi', 'left');
        $this->db->where("tb_peminjaman.status IN ('approved','completed')");

        if ($role_id !=1 && $role_id!=12) {
        $this->db->where("tb_peminjaman.id_user='$id_user'");
        }
        $this->db->order_by("FIELD(tb_peminjaman.status, 'pending', 'approved', 'rejected', 'completed')", NULL, FALSE);
        $this->db->order_by('tb_peminjaman.tgl_mulai', 'ASC'); // Urutkan berdasarkan tgl_mulai terbaru
        return $this->db->get()->result_array();
    }

    // Function to get a specific peminjaman by id
    public function get_peminjaman_by_id($id_peminjaman) {
        return $this->db->get_where('tb_peminjaman', ['id_peminjaman' => $id_peminjaman])->row_array();
    }

    // Function to update peminjaman
    public function update_peminjaman($id_peminjaman, $data) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 120480; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img_pengembalian')) {
            $fileData = $this->upload->data();
            $foto = $fileData['file_name'];
        } else {
            $foto = htmlspecialchars($this->input->post('foto_lama', true)); // Set foto ke foto lama jika tidak ada file baru
        }

        $data = [
            "id_kondisi" => htmlspecialchars($this->input->post('id_kondisi', true)),
            "img_pengembalian" => $foto,
            "ket_pengembalian" => htmlspecialchars($this->input->post('ket_pengembalian', true)),
            "status" => "completed",
        ];

        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->update('tb_peminjaman', $data);


        //Update kondisi aset
        $data = [
            "id_kondisi" => htmlspecialchars($this->input->post('id_kondisi', true))
        ];

        $this->db->where('id_aset', htmlspecialchars($this->input->post('id_aset', true)));
        $this->db->update('tb_aset', $data);
    }

    public function getKondisi()
    {
        return $this->db->get('tb_kondisi')->result_array();
    }

}
?>
