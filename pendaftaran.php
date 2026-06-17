<?php
abstract class Pendaftaran {
    // Properti Terenkapsulasi (protected)
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biaya_pendaftaran_dasar;

    public function __construct($row) {
        $this->id_pendaftaran = $row['id_pendaftaran'];
        $this->nama_calon = $row['nama_calon'];
        $this->asal_sekolah = $row['asal_sekolah'];
        $this->nilai_ujian = $row['nilai_ujian'];
        $this->biaya_pendaftaran_dasar = $row['biaya_pendaftaran_dasar'];
    }

    // Getter dasar untuk kebutuhan penampilan data di View
    public function getIdPendaftaran() { return $this->id_pendaftaran; }
    public function getNamaCalon() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilaiUjian() { return $this->nilai_ujian; }
    public function getBiayaDasar() { return $this->biaya_pendaftaran_dasar; }

    // Abstract Method (Wajib di-override di kelas anak)
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}
?>