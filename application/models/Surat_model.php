<?php defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{
    private $api_base;
    private $api_auth;

    public function __construct()
    {
        parent::__construct();
        $this->api_base = $this->config->item('surat_api_url');
        $this->api_auth = $this->config->item('surat_api_token');
    }

    public function get_surat_filtered($kode_instansi = null, $tahun = null, $key = null) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_base . "/6wvy7?opd=$kode_instansi&tahun=$tahun&key=$key",
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
        $result = json_decode($response);
        $resultArray = $result->result;
        return $resultArray;
    }

    public function get_surat_detail_filtered($no_surat = null) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_base . "/xy3yq?nomor_surat=$no_surat",
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
        $result = json_decode($response);
        $resultArray = $result->result->timeline;
        return $resultArray;
    }
}
