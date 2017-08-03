<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_daftar.php";
$connection = new Database($host, $user, $pass, $database);
$daftar = new Daftar($connection);

$fileName = "excel_daftar-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename='$fileName'");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1px">
	<tr>
		<th>No. Registrasi</th>
  		<th>Tanggal</th>
  		<th>Nama Perusahaan</th>
		<th>Nama Pemohon</th>
		<th>Alamat Perusahaan</th>
		<th>Permohonan Izin</th>
		<th>Tanggal Izin Di Proses</th>
		<th>Back Office</th>
		<th>Tanggal Izin Diambil</th>
		<th>Pendaftaran</th>
	</tr>
	<?php
	$tampil = $daftar->tampil();
	while ($data = $tampil->fetch_object()) {
		echo "<tr>";
		echo "<td>".$data->no_reg."</td>";
		echo "<td>".$data->tgl_masuk."</td>";
		echo "<td>".$data->perusahaan."</td>";
		echo "<td>".$data->pemohon."</td>";
		echo "<td>".$data->alamat_perusahaan."</td>";
		echo "<td>".$data->izin."</td>";
		echo "<td>".$data->tgl_proses."</td>";
		echo "<td>".$data->back_office."</td>";
		echo "<td>".$data->tgl_selesai."</td>";
		echo "<td>".$data->pendaftaran."</td>";
		echo "</tr>";
	}
	?>
</table>