<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tambahagenda_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getAll()
    {
        // return $this->db->get('tb_kondisi')->result_array();
        // $result = $this->db->get('tb_kondisi')->result_array();
        // print_r($result); exit;

        $thisday = date("Y-m-d");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://interop.slemankab.go.id/api/xrp49?tanggal=$thisday",
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

        // print_r($response); exit();

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
            CURLOPT_URL => "https://interop.slemankab.go.id/api/xrp49?tanggal=$thisday",
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
        $user_input     = "dari_satsetslemaset";
        $penerima       = htmlspecialchars($this->input->post('penerima', true));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://interop.slemankab.go.id/api/xqzb6",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "acara=$acara&tanggal=$tanggal&jam_mulai=$jam_mulai&tempat=$tempat&pelaksana=$pelaksana&menghadiri=$menghadiri&keterangan=$keterangan&user_input=$user_input&user_update=$user_input&penerima=$penerima",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic YzBxY2xtM2Y6ZGZ1N2xDamw1UjkzZGhQbDhOOUxTZXpoRFFiY0NzNWo=",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        // print_r($response); exit();

        curl_close($curl);

        // Cek apakah terjadi error pada cURL
        if ($err) {
                // echo json_encode(['status' => 'error', 'message' => 'cURL Error: ' . $err]);
                return $err;
        } else {
            $responseData = json_decode($response, true);

            // Cek apakah respons valid dan sukses
            if ($responseData && isset($responseData['status']) && $responseData['status'] == 'success') {
                // echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan!']);
                $msg = "Data berhasil disimpan";
                return $msg;
            } else {
                // echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
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
