<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Laporan_model');
        $this->load->model('Aset_model');
        is_logged_in();
    }

    public function index()
    {
        $url = $this->uri->segment(1);
        $data['menus'] = $this->Menu_model->getMenuByUrl($url);
        
        $id_aset = htmlspecialchars($this->input->post('id_aset',TRUE));
        $tgl_mulai = htmlspecialchars($this->input->post('tgl_mulai',TRUE));
        $tgl_selesai = htmlspecialchars($this->input->post('tgl_selesai', true));
        $status = htmlspecialchars($this->input->post('status', true));

        $data['user'] = $this->Aset_model->users();
        $data['title'] = 'Peminjaman Aset';

        // Jika ada parameter filter yang diisi, gunakan filter tersebut.
        if ($id_aset || $tgl_mulai || $tgl_selesai || $status) {
            $data['peminjaman'] = $this->Laporan_model->getFiltered($id_aset, $tgl_mulai, $tgl_selesai, $status);
        } else {
            // Jika tidak ada parameter yang diisi, tampilkan semua data.
            $data['peminjaman'] = $this->Laporan_model->getAll();
        }
        
        //mengambil data list aset untuk filter
        $data['aset'] = $this->Aset_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_pdf()
    {
        $data['user'] = $this->Aset_model->users();

        $id_aset = htmlspecialchars($this->input->post('id_aset',TRUE));
        $tgl_mulai = htmlspecialchars($this->input->post('tgl_mulai',TRUE));
        $tgl_selesai = htmlspecialchars($this->input->post('tgl_selesai', true));
        $status = htmlspecialchars($this->input->post('status', true));

        // Jika ada parameter filter yang diisi, gunakan filter tersebut.
        if ($id_aset || $tgl_mulai || $tgl_selesai || $status) {
            $data['peminjaman'] = $this->Laporan_model->getFiltered($id_aset, $tgl_mulai, $tgl_selesai, $status);
        } else {
            // Jika tidak ada parameter yang diisi, tampilkan semua data.
            $data['peminjaman'] = $this->Laporan_model->getAll();
        }

        $data['aset'] = $this->Aset_model->getAll();

        $this->load->library('pdf');
        
        $html = $this->load->view('transaksi/laporan/pdf', $data, true);
        

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream("laporan_peminjaman_aset.pdf", array("Attachment" => 0));
    
    }


    public function export_csv(){

    $id_aset = htmlspecialchars($this->input->post('id_aset',TRUE));
    $tgl_mulai = htmlspecialchars($this->input->post('tgl_mulai',TRUE));
    $tgl_selesai = htmlspecialchars($this->input->post('tgl_selesai', true));
    $status = htmlspecialchars($this->input->post('status', true));

    if ($id_aset || $tgl_mulai || $tgl_selesai || $status) {
        $peminjaman = $this->Laporan_model->getFiltered($id_aset, $tgl_mulai, $tgl_selesai, $status);
    } else {
        $peminjaman = $this->Laporan_model->getAll();
    }

    // Nama file CSV
    $filename = 'Laporan_Peminjaman_Aset_' . date('Y-m-d') . '.csv';

    // Set header untuk file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    // Buka file output untuk menulis
    $output = fopen('php://output', 'w');

    // Tulis header kolom
    fputcsv($output, [
        'No',
        'Nama Aset',
        'Kategori',
        'Nama Peminjam',
        'Instansi',
        'Acara',
        'Tanggal Mulai',
        'Tanggal Selesai',
        'Status',
        'Keterangan'
    ]);

    $no = 1;
    foreach ($peminjaman as $item) {
        fputcsv($output, [
            $no++,
            $item['nama_aset'],
            $item['kategori'],
            $item['nama_peminjam'],
            $item['instansi'],
            $item['acara'],
            $item['tgl_mulai'],
            $item['tgl_selesai'],
            $item['status'],
            $item['ket']
        ]);
    }

    fclose($output);
    exit;
}




}

?>
