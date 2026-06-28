
<div style="text-align: center; border-bottom: 2px solid #1a1a2e; margin-bottom: 20px; padding-bottom: 10px;">
    <div style="text-align: center;">
        <h3 style="margin: 0; font-weight: bold; color: #1a1a2e;">STRYX</h3>
        <h4 style="margin: 4px 0; color: #333;">Threat Response &amp; Yber Assessment</h4>
        <p style="margin: 5px 0 0 0; font-size: 11px; color: #666;">
            Laporan Peminjaman Aset
        </p>
    </div>
</div>



<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    table th {
        background-color: #f4f4f4;
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
    }
    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    table tr:nth-child(odd) {
        background-color: #ffffff;
    }
    table tr:hover {
        background-color: #f1f1f1;
    }
</style>

<h3 style="text-align: center; margin-top: 20px;">Laporan Peminjaman Aset</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Aset</th>
            <th>Nama Peminjam</th>
            <th>Instansi</th>
            <th>Acara</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($peminjaman as $item): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $item['nama_aset'] ?></td>
            <td><?= $item['nama_peminjam'] ?></td>
            <td><?= $item['instansi'] ?></td>
            <td><?= $item['acara'] ?></td>
            <td><?= $item['tgl_mulai'] ?></td>
            <td><?= $item['tgl_selesai'] ?></td>
            <td><?= $item['status'] ?></td>
            <td><?= $item['ket'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
