<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_daftar.php";
$connection = new Database($host, $user, $pass, $database);
$daftar = new Daftar($connection);
$content = '
<style>
.table { border-collapse:collapse;}
.table th {padding:8px 5px; background-color:#f60; color:#fff;}
</style>
';
$content .= '
	<page>
		<div style="padding:4mm; border:1px solid; align:center">
			<span style="font-size:25px;">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</span>
		</div>
		<div style="padding:20px 0 10px 0; font-size:15px;">
			Laporan Registrasi Pendaftaran
		</div>

		<table border="1px">
			<tr>

			</tr>
		</table>
	</page>
';

require_once('../assets/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('exemple.pdf');
?>