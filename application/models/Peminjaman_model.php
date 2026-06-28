<?php defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        $id_user = $this->session->userdata('id_user');
        $role_id = $this->session->userdata('role_id');
        $this->db->select('tb_peminjaman.*, tb_aset.nama as nama_aset');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_peminjaman.id_aset = tb_aset.id_aset');

        if ($role_id !=1 && $role_id!=12) {
        $this->db->where("tb_peminjaman.id_user='$id_user'");
        }
        
        $this->db->order_by('tb_peminjaman.tgl_mulai', 'DESC'); // Urutkan berdasarkan tgl_mulai terbaru
        return $this->db->get()->result_array();
    }

    public function addPeminjaman($data)
    {
        $this->db->insert('tb_peminjaman', $data);
    }

    public function checkAvailability($id_aset, $tgl_mulai, $tgl_selesai)
    {
        $this->db->where('id_aset', $id_aset);
        $this->db->group_start();
            $this->db->where('"'. $tgl_mulai .'" BETWEEN tgl_mulai AND tgl_selesai', null, false);
            $this->db->or_where('"'. $tgl_selesai .'" BETWEEN tgl_mulai AND tgl_selesai', null, false);
            $this->db->or_where('tgl_mulai BETWEEN "'. $tgl_mulai .'" AND "'. $tgl_selesai .'"', null, false);
            $this->db->or_where('tgl_selesai BETWEEN "'. $tgl_mulai .'" AND "'. $tgl_selesai .'"', null, false);
        $this->db->group_end();
        $query = $this->db->get('tb_peminjaman');
        return $query->num_rows();
    }

    // Function to get a specific peminjaman by id
    public function get_peminjaman_by_id($id_peminjaman) {
        return $this->db->get_where('tb_peminjaman', ['id_peminjaman' => $id_peminjaman])->row_array();
    }

    // Function to update peminjaman
    public function update_peminjaman($id_peminjaman, $data) {
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->update('tb_peminjaman', $data);
    }

    // Function to delete peminjaman
    public function delete_peminjaman($id_peminjaman) {
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->delete('tb_peminjaman');
    }

    public function checkAvailabilityDetail($id_aset, $tgl_mulai, $tgl_selesai)
    {
        $tersedia =[];
        $kosong =[];

        $this->db->where('id_aset', $id_aset);
        $this->db->group_start();
            $this->db->where('"'. $tgl_mulai .'" BETWEEN tgl_mulai AND tgl_selesai', null, false);
            $this->db->or_where('"'. $tgl_selesai .'" BETWEEN tgl_mulai AND tgl_selesai', null, false);
            $this->db->or_where('tgl_mulai BETWEEN "'. $tgl_mulai .'" AND "'. $tgl_selesai .'"', null, false);
            $this->db->or_where('tgl_selesai BETWEEN "'. $tgl_mulai .'" AND "'. $tgl_selesai .'"', null, false);
        $this->db->group_end();
        // Tambahkan pengecekan status, hanya pertimbangkan peminjaman yang belum 'completed'
        // $this->db->where('status !=', 'completed');
        $this->db->where_not_in('status', ['completed', 'rejected']);

        $tersedia = $this->db->get('tb_peminjaman')->result_array();

        if (empty($tersedia)) {
            $data =[];
            $this->db->select('*');
            $this->db->from('tb_aset');
            $this->db->where('id_aset', $id_aset);
            $datanya = $this->db->get()->result_array();
            $data[0]['id_aset']=$datanya[0]['id_aset'];
            $data[0]['nama_aset']=$datanya[0]['nama'];
            $data[0]['foto']=$datanya[0]['foto'];
            $data[0]['cp_pengampu']=$datanya[0]['cp_pengampu'];

            if(!empty($datanya[0]['kapasitas'])){
                $keterangan = 'Kapasitas : '. $datanya[0]['kapasitas'] .'<br>'. $datanya[0]['ket'];
            }else {
                $keterangan = $datanya[0]['ket'];
            }

            $data[0]['ket']=$keterangan;
            $data[0]['tgl_mulai'] = $tgl_mulai;
            $data[0]['tgl_selesai'] = $tgl_selesai;
            return $data;
        } else {
            return $kosong;
        }   

        
    }

    public function get_ruangan() {
        $this->db->select('id_aset, nama');
        $this->db->from('tb_aset');
        $this->db->where('id_kategori', 3); // ID kategori untuk "Ruang"
        $this->db->order_by("nama", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_instansi() {
        $this->db->select('kode_instansi, instansi');
        $this->db->from('tb_instansi');
        $this->db->where("kode_instansi !=", 'null'); // hindari string 'null'
        $this->db->where("kode_instansi NOT LIKE '%.%'", NULL, FALSE); // gunakan FALSE agar tidak di-escape
        $this->db->where_not_in('kode_instansi', ['70', '71']); // hindari kode 70 dan 71
        $this->db->order_by("kode_instansi", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_agenda_filtered($id_aset = null, $tanggal = null) {
        $this->db->select('tb_peminjaman.*, tb_aset.nama as nama_ruang, tb_kategori.kategori');
        $this->db->from('tb_peminjaman');
        $this->db->join('tb_aset', 'tb_peminjaman.id_aset = tb_aset.id_aset');
        $this->db->join('tb_kategori', 'tb_aset.id_kategori = tb_kategori.id_kategori');
        $this->db->where('tb_kategori.kategori', 'Ruang');
        $this->db->where('tb_peminjaman.status', 'approved');
        $this->db->where('DATE(tb_peminjaman.tgl_mulai) <=', date('Y-m-d'));
        $this->db->where('DATE(tb_peminjaman.tgl_selesai) >=', date('Y-m-d'));
        // $this->db->where('DATE(tb_peminjaman.tgl_mulai)', date('Y-m-d'));
         $this->db->order_by('tb_peminjaman.tgl_mulai', 'ASC');
        // if ($id_aset) {
        //     $this->db->where('tb_peminjaman.id_aset', $id_aset);
        // }
        // if ($tanggal) {
        //     $this->db->where('DATE(tb_peminjaman.tgl_mulai)', $tanggal);
        // } else {
        //     $this->db->where('DATE(tb_peminjaman.tgl_mulai)', date('Y-m-d')); // default hari ini
        // }

        $query = $this->db->get();
        return $query->result();
    }


}
?>