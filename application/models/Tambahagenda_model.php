<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tambahagenda_model extends CI_Model
{
    private $api_base;
    private $api_auth;

    public function __construct()
    {
        parent::__construct();
        $this->api_base = $this->config->item('agenda_api_url');
        $this->api_auth = $this->config->item('agenda_api_token');
    }

    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        $thisday = date("Y-m-d");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_base . "/xrp49?tanggal=$thisday",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . $this->api_auth
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        $resultArray = $result['result'];
        return $resultArray;
    }

    public function getFiltered($tanggal)
    {
        $thisday = $tanggal;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_base . "/xrp49?tanggal=$thisday",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . $this->api_auth
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        $resultArray = $result['result'];
        return $resultArray;
    }

    public function AddData()
    {
        $acara          = htmlspecialchars($this->input->post('acara', true));
        $tanggal        = htmlspecialchars($this->input->post('tanggal', true));
        $jam_mulai      = htmlspecialchars($this->input->post('jam_mulai', true));
        $tempat         = htmlspecialchars($this->input->post('tempat', true));
        $pelaksana      = htmlspecialchars($this->input->post('pelaksana', true));
        $menghadiri     = htmlspecialchars($this->input->post('menghadiri', true));
        $keterangan     = htmlspecialchars($this->input->post('keterangan', true));
        $user_input     = "stryx";
        $penerima       = htmlspecialchars($this->input->post('penerima', true));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_base . "/xqzb6",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "acara=$acara&tanggal=$tanggal&jam_mulai=$jam_mulai&tempat=$tempat&pelaksana=$pelaksana&menghadiri=$menghadiri&keterangan=$keterangan&user_input=$user_input&user_update=$user_input&penerima=$penerima",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . $this->api_auth,
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $responseData = json_decode($response, true);

            if ($responseData && isset($responseData['status']) && $responseData['status'] == 'success') {
                $msg = "Data berhasil disimpan";
                return $msg;
            } else {
                $msg = "Gagal menyimpan data";
                return $msg;
            }
        }
    }

    public function EditData()
    {
        $data = [
            "kondisi" => htmlspecialchars($this->input->post('kondisi', true)),
            "ket" => htmlspecialchars($this->input->post('ket', true)),
        ];

        $this->db->where('id_kondisi', htmlspecialchars($this->input->post('id_kondisi')));
        $this->db->update('tb_kondisi', $data);
    }

    public function getById($id_kondisi)
    {
        return $this->db->get_where('tb_kondisi', ['id_kondisi' => $id_kondisi])->row_array();
    }

    public function DeleteData($id_kondisi)
    {
        // $this->db->delete('tb_kondisi', ['id_kondisi' => $id_kondisi]);
    }
}
