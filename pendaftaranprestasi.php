<?php
require_once 'Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    // Properti tambahan spesifik
    private $jenis_prestasi;
    private $tingkat_prestasi;

    public function __construct($row) {
        parent::__construct($row);
        $this->jenis_prestasi = $row['jenis_prestasi'];
        $this->tingkat_prestasi = $row['tingkat_prestasi'];
    }

    // Tahap 4: Metode Query Spesifik Jalur Prestasi
    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $list = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new PendaftaranPrestasi($row);
        }
        return $list;
    }

    // Tahap 5: Overriding Perhitungan Biaya (Potongan 50.000)
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar - 50000;
    }

    // Polimorfisme Cetak Informasi Unik
    public function tampilkanInfoJalur() {
        return "Prestasi: " . $this->jenis_prestasi . " [Tingkat " . $this->tingkat_prestasi . "]";
    }
}
?>