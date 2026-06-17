<?php
require_once 'database.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

// 1. Inisialisasi Koneksi Database
$database = new Database();
$db = $database->getConnection();

$dataReguler = [];
$dataPrestasi = [];
$dataKedinasan = [];
$error_koneksi = false;

// 2. Validasi Koneksi
if ($db === null) {
    $error_koneksi = true;
} else {
    $dataReguler = PendaftaranReguler::getDaftarReguler($db);
    $dataPrestasi = PendaftaranPrestasi::getDaftarPrestasi($db);
    $dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($db);
}

// 3. Helper Function untuk merender tabel dengan desain modern (Tahap 6)
function renderTable($daftarMahasiswa, $namaJalur) {
    echo "<div class='table-responsive'>
            <table>
                <thead>
                    <tr>
                        <th width='5%'>ID</th>
                        <th width='23%'>Nama Calon</th>
                        <th width='17%'>Asal Sekolah</th>
                        <th width='10%'>Nilai Ujian</th>
                        <th width='15%'>Biaya Dasar</th>
                        <th width='15%'>Informasi Spesifik Jalur</th>
                        <th width='15%'>Total Biaya Akhir</th>
                    </tr>
                </thead>
                <tbody>";
    
    if (empty($daftarMahasiswa)) {
        echo "<tr><td colspan='7' class='text-center text-muted'>Tidak ada data calon mahasiswa untuk jalur ini.</td></tr>";
    } else {
        foreach ($daftarMahasiswa as $mhs) {
            echo "<tr>
                    <td class='text-center font-bold'>".$mhs->getIdPendaftaran()."</td>
                    <td class='font-semibold text-dark'>".$mhs->getNamaCalon()."</td>
                    <td>".$mhs->getAsalSekolah()."</td>
                    <td class='text-center'><span class='badge badge-info'>".$mhs->getNilaiUjian()."</span></td>
                    <td>Rp ".number_format($mhs->getBiayaDasar(), 0, ',', '.')."</td>
                    <td><span class='text-spesifik'>".$mhs->tampilkanInfoJalur()."</span></td>
                    <td class='text-right font-bold text-primary'>Rp ".number_format($mhs->hitungTotalBiaya(), 0, ',', '.')."</td>
                  </tr>";
        }
    }
    echo "    </tbody>
            </table>
          </div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PMB - Universitas PBO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS RESET & BASE STYLES */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f4f6f9; color: #333; padding: 40px 20px; }
        
        .container { max-width: 1200px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        
        /* HEADER STYLES */
        header { text-align: center; margin-bottom: 35px; border-bottom: 2px solid #eaedf2; padding-bottom: 20px; }
        header h1 { color: #1e293b; font-size: 26px; font-weight: 700; letter-spacing: -0.5px; margin-bottom: 5px; }
        header p { color: #64748b; font-size: 14px; }

        /* MENU NAVIGASI / PILIH JALUR (TABS) */
        .nav-menu { display: flex; justify-content: center; gap: 10px; margin-bottom: 30px; background: #f1f5f9; padding: 6px; border-radius: 8px; }
        .nav-btn { background: none; border: none; padding: 10px 20px; font-size: 14px; font-weight: 600; color: #64748b; cursor: pointer; border-radius: 6px; transition: all 0.2s ease-in-out; }
        .nav-btn:hover { color: #1e293b; background: #e2e8f0; }
        .nav-btn.active { background: #ffffff; color: #2563eb; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

        /* CONTENT CARD STYLES */
        .jalur-section { display: none; margin-bottom: 20px; animation: fadeIn 0.4s ease; }
        .jalur-section.active { display: block; }
        
        .section-title { font-size: 18px; color: #1e293b; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
        .section-title::before { content: ''; display: inline-block; width: 4px; height: 18px; background: #2563eb; border-radius: 2px; }

        /* MODERN TABLE STYLES */
        .table-responsive { width: 100%; overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 8px; background: #ffffff; margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background-color: #f8fafc; color: #475569; font-weight: 600; padding: 14px 16px; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #475569; }
        tr:hover td { background-color: #f8fafc; }
        
        /* UTILITY CLASSES */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .text-dark { color: #1e293b; }
        .text-primary { color: #2563eb; }
        .text-spesifik { font-style: italic; color: #0f766e; background: #ccfbf1; padding: 4px 8px; border-radius: 4px; font-size: 13px; }
        
        /* BADGE STYLES */
        .badge { display: inline-block; padding: 4px 8px; font-size: 12px; font-weight: 600; border-radius: 4px; }
        .badge-info { background-color: #dbeafe; color: #1e40af; }

        /* ERROR BOX STYLES */
        .error-box { background-color: #fef2f2; color: #991b1b; padding: 25px; border: 1px solid #fee2e2; border-radius: 8px; margin: 20px 0; }
        .error-box h4 { font-size: 18px; margin-bottom: 10px; font-weight: 600; }
        .error-box ol { padding-left: 20px; line-height: 1.6; font-size: 14px; }
        
        /* ANIMATION */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>SISTEM MANAJEMEN PENDAFTARAN MAHASISWA BARU</h1>
        <p>Universitas PBO &bull; Data Calon Mahasiswa Berdasarkan Jalur Spesifik</p>
    </header>

    <?php if ($error_koneksi): ?>
        <div class="error-box">
            <h4>⚠️ Koneksi Database Gagal!</h4>
            <p>Aplikasi tidak dapat memuat data. Silakan lakukan perbaikan berikut:</p>
            <ol>
                <li>Pastikan server MySQL di XAMPP/Laragon sudah Anda aktifkan (Running).</li>
                <li>Pastikan database sudah dibuat di phpMyAdmin.</li>
                <li>Buka file <code>koneksi/database.php</code> dan ganti nilai <code>$db_name</code> dengan nama database Anda yang sebenarnya.</li>
            </ol>
        </div>
    <?php else: ?>
        
        <div class="nav-menu">
            <button class="nav-btn active" onclick="filterJalur('semua', this)">🌟 Semua Jalur</button>
            <button class="nav-btn" onclick="filterJalur('reguler', this)">🔹 Jalur Reguler</button>
            <button class="nav-btn" onclick="filterJalur('prestasi', this)">⭐ Jalur Prestasi</button>
            <button class="nav-btn" onclick="filterJalur('kedinasan', this)">🏛️ Jalur Kedinasan</button>
        </div>

        <div id="sec-reguler" class="jalur-section active">
            <div class="section-title">Kategori Jalur Reguler</div>
            <?php renderTable($dataReguler, "Reguler"); ?>
        </div>

        <div id="sec-prestasi" class="jalur-section active">
            <div class="section-title">Kategori Jalur Prestasi</div>
            <?php renderTable($dataPrestasi, "Prestasi"); ?>
        </div>

        <div id="sec-kedinasan" class="jalur-section active">
            <div class="section-title">Kategori Jalur Kedinasan</div>
            <?php renderTable($dataKedinasan, "Kedinasan"); ?>
        </div>

    <?php endif; ?>
</div>

<script>
function filterJalur(jalur, elemenTombol) {
    // 1. Hapus kelas 'active' dari semua tombol menu pendorong
    const semuaTombol = document.querySelectorAll('.nav-btn');
    semuaTombol.forEach(btn => btn.classList.remove('active'));
    
    // 2. Tambahkan kelas 'active' pada tombol yang sedang diklik
    elemenTombol.classList.add('active');
    
    // 3. Logika penyaringan visibilitas section tabel
    const semuaSection = document.querySelectorAll('.jalur-section');
    
    if (jalur === 'semua') {
        // Tampilkan semua section tabel sekaligus
        semuaSection.forEach(sec => sec.classList.add('active'));
    } else {
        // Sembunyikan semua dulu, lalu munculkan yang dipilih saja
        semuaSection.forEach(sec => sec.classList.remove('active'));
        
        const targetSection = document.getElementById('sec-' + jalur);
        if (targetSection) {
            targetSection.classList.add('active');
        }
    }
}
</script>

</body>
</html>