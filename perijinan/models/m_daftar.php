
<?php
class Daftar {

	private $mysqli;

	function __construct($conn) {
		$this->mysqli = $conn;
	}

	public function tampil($no_reg = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM registrasi";
		if($no_reg != null) {
			$sql .= " WHERE no_reg = $no_reg";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}
	public function tambah($no_reg, $tgl_masuk, $perusahaan, $pemohon, $alamat_perusahaan, $izin, $back_office, $pendaftaran) {
		$db = $this->mysqli->conn;
		$db->query ("INSERT INTO registrasi VALUES ('$no_reg', '$tgl_masuk', '$perusahaan', '$pemohon', '$alamat_perusahaan', '$izin', '', '$back_office', '', '$pendaftaran')") or die ($db->error);
	}
}
?>