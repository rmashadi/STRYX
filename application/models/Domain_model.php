<?php defined('BASEPATH') or exit('No direct script access allowed');

class Domain_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        // return $this->db->order_by('id_domain', 'ASC')->get('tb_domain')->result_array();
        $this->db->select('tb_instansi.instansi, tb_domain.*, tb_subdomain.jns_subdomain, tb_geopasial.status_geopasial, tb_pribadi.status_pribadi, tb_kat_aplikasi.kat_aplikasi, tb_status_api.status_api, tb_status_sdm.status_sdm, tb_status_aplikasi.status_apl');
        $this->db->from('tb_domain');
        $this->db->join('tb_instansi', 'tb_domain.id_instansi = tb_instansi.id_instansi');
        // $this->db->join('tb_platform', 'tb_domain.id_platform = tb_platform.id_platform');
        $this->db->join('tb_subdomain', 'tb_domain.id_jns_subdomain = tb_subdomain.id_jns_subdomain');
        $this->db->join('tb_geopasial', 'tb_domain.id_geopasial = tb_geopasial.id_geopasial');
        $this->db->join('tb_pribadi', 'tb_domain.id_pribadi = tb_pribadi.id_pribadi');
        $this->db->join('tb_kat_aplikasi', 'tb_domain.id_kat_aplikasi = tb_kat_aplikasi.id_kat_aplikasi');
        $this->db->join('tb_status_api', 'tb_domain.id_status_api = tb_status_api.id_status_api');
        $this->db->join('tb_status_sdm', 'tb_domain.id_status_sdm = tb_status_sdm.id_status_sdm');
        $this->db->join('tb_status_aplikasi', 'tb_domain.id_status_apl = tb_status_aplikasi.id_status_apl');
        return $this->db->get()->result_array();

    }

    public function AddData()
    {

        $platform = $this->input->post('id_platform', true);
        $platform_str = is_array($platform) ? implode(',', $platform) : '';


        $data = [

            "id_instansi" => htmlspecialchars($this->input->post('id_instansi', true)),
            "nama_aplikasi" => htmlspecialchars($this->input->post('nama_aplikasi', true)),
            "alamat_url_dev" => htmlspecialchars($this->input->post('alamat_url_dev', true)),
            "alamat_url_publish" => htmlspecialchars($this->input->post('alamat_url_publish', true)),
            "tahun_pembuatan" => htmlspecialchars($this->input->post('tahun_pembuatan', true)),
            "pengembang" => htmlspecialchars($this->input->post('pengembang', true)),
            "id_platform" => $platform_str,
            "id_jns_subdomain" => htmlspecialchars($this->input->post('id_jns_subdomain', true)),
            "id_geopasial" => htmlspecialchars($this->input->post('id_geopasial', true)),
            "id_pribadi" => htmlspecialchars($this->input->post('id_pribadi', true)),
            "id_kat_aplikasi" => htmlspecialchars($this->input->post('id_kat_aplikasi', true)),
            "deskripsi_singkat" => htmlspecialchars($this->input->post('deskripsi_singkat', true)),
            "daftar_layanan" => htmlspecialchars($this->input->post('daftar_layanan', true)),
            "data_yang_diolah" => htmlspecialchars($this->input->post('data_yang_diolah', true)),
            "daftar_produk" => htmlspecialchars($this->input->post('daftar_produk', true)),
            "id_status_api" => htmlspecialchars($this->input->post('id_status_api', true)),
            "id_status_sdm" => htmlspecialchars($this->input->post('id_status_sdm', true)),
            "tanggal_launching" => htmlspecialchars($this->input->post('tanggal_launching', true)),
            "id_status_apl" => htmlspecialchars($this->input->post('id_status_apl', true)),
            "user_input" => $this->session->userdata('name'),
            "tgl_input" => (date('Y-m-d H:i:s')),

        ];

        $this->db->insert('tb_domain', $data);
    }

    public function EditData()
    {

        $platform =  $this->input->post('id_platform', true);
        $platform_str = is_array($platform) ? implode(',', $platform) : '';

         $data = [

            "id_instansi" => htmlspecialchars($this->input->post('id_instansi', true)),
            "nama_aplikasi" => htmlspecialchars($this->input->post('nama_aplikasi', true)),
            "alamat_url_dev" => htmlspecialchars($this->input->post('alamat_url_dev', true)),
            "alamat_url_publish" => htmlspecialchars($this->input->post('alamat_url_publish', true)),
            "tahun_pembuatan" => htmlspecialchars($this->input->post('tahun_pembuatan', true)),
            "pengembang" => htmlspecialchars($this->input->post('pengembang', true)),
            "id_platform" => $platform_str,
            "id_jns_subdomain" => htmlspecialchars($this->input->post('id_jns_subdomain', true)),
            "id_geopasial" => htmlspecialchars($this->input->post('id_geopasial', true)),
            "id_pribadi" => htmlspecialchars($this->input->post('id_pribadi', true)),
            "id_kat_aplikasi" => htmlspecialchars($this->input->post('id_kat_aplikasi', true)),
            "deskripsi_singkat" => htmlspecialchars($this->input->post('deskripsi_singkat', true)),
            "daftar_layanan" => htmlspecialchars($this->input->post('daftar_layanan', true)),
            "data_yang_diolah" => htmlspecialchars($this->input->post('data_yang_diolah', true)),
            "daftar_produk" => htmlspecialchars($this->input->post('daftar_produk', true)),
            "id_status_api" => htmlspecialchars($this->input->post('id_status_api', true)),
            "id_status_sdm" => htmlspecialchars($this->input->post('id_status_sdm', true)),
            "tanggal_launching" => htmlspecialchars($this->input->post('tanggal_launching', true)),
            "id_status_apl" => htmlspecialchars($this->input->post('id_status_apl', true)),
            "user_update" => $this->session->userdata('name'),
            "tgl_update" => (date('Y-m-d H:i:s')),

        ];

        $this->db->where('id_domain', htmlspecialchars($this->input->post('id_domain'),true));
        $this->db->update('tb_domain', $data);
    }

    public function getById($id_domain)
    {
        return $this->db->get_where('tb_domain', ['id_domain' => $id_domain])->row_array();
    }

    public function DeleteData($id_domain)
    {
        $this->db->delete('tb_domain', ['id_domain' => $id_domain]);
    }

        public function getInstansi()
    {
        return $this->db->get('tb_instansi')->result_array();
    }

         public function getPlatform()
    {
        return $this->db->get('tb_platform')->result_array();
    }

         public function getSubdomain()
    {
        return $this->db->get('tb_subdomain')->result_array();
    }

         public function getGeopasial()
    {
        return $this->db->get('tb_geopasial')->result_array();
    }

         public function getPribadi()
    {
        return $this->db->get('tb_pribadi')->result_array();
    }

         public function getKataplikasi()
    {
        return $this->db->get('tb_kat_aplikasi')->result_array();
    }

         public function getStatusApi()
    {
        return $this->db->get('tb_status_api')->result_array();
    }

         public function getStatusSdm()
    {
        return $this->db->get('tb_status_sdm')->result_array();
    }

         public function getStatusAplikasi()
    {
        return $this->db->get('tb_status_aplikasi')->result_array();
    }
}
