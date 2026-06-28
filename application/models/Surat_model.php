<?php defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{
    public function get_surat_filtered($kode_instansi = null, $tahun = null, $key = null) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://interop.slemankab.go.id/api/6wvy7?opd=$kode_instansi&tahun=$tahun&key=$key",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic YzBxY2xtM2Y6ZGZ1N2xDamw1UjkzZGhQbDhOOUxTZXpoRFFiY0NzNWo="
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
            CURLOPT_URL => "https://interop.slemankab.go.id/api/xy3yq?nomor_surat=$no_surat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic YzBxY2xtM2Y6ZGZ1N2xDamw1UjkzZGhQbDhOOUxTZXpoRFFiY0NzNWo="
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $result = json_decode($response);
        // print_r($result->result->timeline); exit();
        $resultArray = $result->result->timeline;
        return $resultArray;

    }

    
}

?>