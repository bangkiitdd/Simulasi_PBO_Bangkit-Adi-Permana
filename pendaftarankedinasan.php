<?php
require_once 'Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    // Properti tambahan spesifik
    private $sk_ikatan_dinas;
    private $instansi_sponsor;

    public function __construct($row) {
        parent::__construct($row);
        $this->sk_ikatan_dinas = $row['sk_ikatan_dinas'];
        $this->instansi_sponsor = $row['instansi_sponsor'];
    }

    // Tahap 4: Metode Query Spesifik Jalur Kedinasan
    public static function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $list = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new PendaftaranKedinasan($row);
        }
        return $list;
    }

     // Tahap 5: Overriding Perhitungan Biaya (Surcharge 25% -> dikali 1.25)
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar * 1.25;
    }

    // Polimorfisme Cetak Informasi Unik
    public function tampilkanInfoJalur() {
        return "Sponsor: " . $this->instansi_sponsor . " (No. SK: " . $this->sk_ikatan_dinas . ")";
    }
}
?>