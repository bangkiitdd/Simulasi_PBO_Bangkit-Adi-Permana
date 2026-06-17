<?php
require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    // Properti tambahan spesifik
    private $pilihan_prodi;
    private $lokasi_kampus;

    public function __construct($row) {
        parent::__construct($row);
        $this->pilihan_prodi = $row['pilihan_prodi'];
        $this->lokasi_kampus = $row['lokasi_kampus'];
    }

    // Tahap 4: Metode Query Spesifik Jalur Reguler
    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $list = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new PendaftaranReguler($row);
        }
        return $list;
    }

    // Tahap 5: Overriding Perhitungan Biaya (Murni Biaya Dasar)
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar;
    }

    // Polimorfisme Cetak Informasi Unik
    public function tampilkanInfoJalur() {
        return "Prodi: " . $this->pilihan_prodi . " (" . $this->lokasi_kampus . ")";
    }
}
?>