<?php
include "models/m_daftar.php";

$daftar = new Daftar($connection);

?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Pendaftaran<small> Data Perusahaan</small></h2>
        <ol class="breadcrumb">
        	<li><a href="?page=dashboard"><i class="fa fa-dashboard"></i></a></li>
        	<li><a href="">Pendaftaran</a></li>
            <li class="active">Data Perusahaan</li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">	
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped" id="datatables">
			<thead>
			<tr>
				<th>No. Registrasi</th>
  				<th>Tanggal</th>
  				<th>Nama Perusahaan</th>
				<th>Nama Pemohon</th>
				<th>Alamat Perusahaan</th>
				<th>Permohonan Izin</th>
				<th>Pendaftaran</th>
				<th>Tanda Terima</th>
				
			</tr>
			</thead>
			<tbody>
					<?php
					$no_reg = null;
						$tampil = $daftar->tampil();
					  while($data = $tampil->fetch_object()) {
					  	?>
					<tr>
  					<td align="center"><?php echo $data->no_reg; ?></td>
  					<td><?php echo $data->tgl_masuk; ?></td>
  					<td><?php echo $data->perusahaan; ?></td>
  					<td><?php echo $data->pemohon; ?></td>
  					<td><?php echo $data->alamat_perusahaan; ?></td>
  					<td><?php echo $data->izin; ?></td>
  					<td align="center"><?php echo $data->pendaftaran; ?></td>
					<td align="center">
						<a href="./report/cetak_daftar.php?id=$data->no_reg; ?>" target="_blank"><button class="btn btn-print btn-xs"><i class="fa fa-print"></i> Cetak</button></a>
					</td>
								
					</tr>
					<?php
					}
					?>
			</tbody>
		</table>
		</div>
		
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Baru</button>
		<a href="./report/export_excel_daftar.php" target="_blank">
		<button class="btn btn-default"><i class="fa fa-print"></i> Export Excel</button>
		
					<div id="tambah" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Registrasi Pendaftaran Perusahaan</h4>
					</div>
					<form action="" method="post" enctype="form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="no_reg">Nomor Registrasi</label>
									<input type="text" name="no_reg" class="form-control" id="no_reg" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="tgl_masuk">Tanggal Registrasi</label>
									<input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" placeholder="Contoh : 2017-01-30" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="perusahaan">Nama Perusahaan</label>
									<input type="text" name="perusahaan" class="form-control" id="perusahaan" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="pemohon">Nama Pemohon</label>
									<input type="text" name="pemohon" class="form-control" id="pemohon" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="alamat_perusahaan">Alamat Perusahan</label>
									<input type="text" name="alamat_perusahaan" class="form-control" id="alamat_perusahaan" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="izin">Permohonan Izin</label>
									<input type="text" name="izin" class="form-control" id="izin" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="back_office">Back Office</label>
									<input type="text" name="back_office" class="form-control" id="back_office" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="pendaftaran">Pendaftaran</label>
									<input type="text" name="pendaftaran" class="form-control" id="pendaftaran"   required="" >
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-danger">Reset</button>
							<input type="submit" class="btn btn-success" name="tambah" value="simpan">
					</div>
					</form>
					<?php
					if(@$_POST['tambah']) {
						$no_reg = $connection->conn->real_escape_string($_POST['no_reg']);
						$tgl_masuk = $connection->conn->real_escape_string($_POST['tgl_masuk']);
						$perusahaan = $connection->conn->real_escape_string($_POST['perusahaan']);
						$pemohon = $connection->conn->real_escape_string($_POST['pemohon']);
						$alamat_perusahaan = $connection->conn->real_escape_string($_POST['alamat_perusahaan']);
						$izin = $connection->conn->real_escape_string($_POST['izin']);
						$back_office = $connection->conn->real_escape_string($_POST['back_office']);
						$pendaftaran = $connection->conn->real_escape_string($_POST['pendaftaran']);
						
						$daftar->tambah($no_reg, $tgl_masuk, $perusahaan, $pemohon, $alamat_perusahaan, $izin, $back_office, $pendaftaran);  
								header("location: ?page=daftar");
								
							
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>