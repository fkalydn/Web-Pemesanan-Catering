<?php 
	include"../inc/config.php"; 
	validate_admin_not_login("login.php");
		
	include"inc/header.php";
	
?> 
	
	<div class="container">
		<?php
			$q = $koneksi->query("SELECT*FROM pembayaran order by status asc");
			$j = mysqli_num_rows($q);
		?>
		<!--Query update info-->
		<div class="row">
		<div class="col-md-12">
		<?php
			if(!empty($_GET)){
				if ($_GET['act'] == "info") {
					$qInfo = $koneksi->query("SELECT * FROM info_pembayaran limit 1") or die (mysqli_error());
					$dInfo = mysqli_fetch_object($qInfo);
					if (!empty($_POST)) {
						extract($_POST);
						$query = $koneksi->query("UPDATE info_pembayaran SET info='$info' where id='1'") or die (mysqli_error());
						if ($query) {
							alert('Info Pembayaran Berhasil Diupdate');
							redir('pembayaran.php');
						}
					}
					?>
					<div class="col-md-6">
						<div class="row">
							<h3>Info Pembayaran</h3>
							<form action="" method="POST">
								<textarea class="form-control" name="info"><?php echo $dInfo->info; ?></textarea>
								<div class="form-group">
									<br>
									<input type="submit" name="submit" value="Submit" class="btn btn-success">
								</div>
							</form>
						</div>
					</div>
					<hr/>
				<!-- END INFO -->
				<?php
				}
				if ($_GET['act'] == "verified") {
					extract($_GET);
					$updatePembayaran = $koneksi->query("UPDATE pembayaran set status = 'verified' where id='$_GET[id]'");
					if ($updatePembayaran) {
						$qPembayaran = $koneksi->query("SELECT * FROM pembayaran where id_pesanan='$id_pesanan' and status='verified'") or die (mysqli_error());
						$totalPembayaran = 0;
						while ($d = mysqli_fetch_object($qPembayaran)) {
							$totalPembayaran += $d->total;
						}

						$q1 = $koneksi->query("SELECT * FROM detail_pesanan where pesanan_id='$id_pesanan'");
						$totalBayar = 0;
						while($data2=mysqli_fetch_object($q1)){
							$katpro1 = $koneksi->query("SELECT * FROM produk where id='$data2->produk_id'");
							$a = mysqli_fetch_object($katpro1);
							$totalBayar += ($a->harga * $data2->qty);
						}

						$q3 = $koneksi->query("SELECT * FROM pesanan where id='$id_pesanan'") or die (mysqli_error());
						$pesanan = mysqli_fetch_object($q3);

						$totalBayar += $pesanan->ongkir;
						if ($totalBayar <= $totalPembayaran) {
							$updatePesanan = $koneksi->query("UPDATE pesanan set status='lunas' where id='$id_pesanan'") or die (mysqli_error());
							if ($updatePesanan) {
								alert("Pembayaran Lunas");
							}
						}
						alert("Pembayaran Telah Di Verifikasi");
						redir('pembayaran.php');
					}
				}
				// query detail
				if ($_GET['act'] == "detail") {
					$dataPembayaran = mysqli_fetch_object($koneksi->query("SELECT * FROM pembayaran where id=$_GET[id]"));
					$dataPesanan = mysqli_fetch_object($koneksi->query("SELECT * FROM pesanan where id='$dataPembayaran->id_pesanan'"))
					?>
					<div class="col-md-6">
						<h3> Detail Pembayaran</h3>
						<table class="table table-striped">
							<tbody>
								<tr>
									<td>Nama</td>
									<td><?php echo $dataPesanan->nama; ?></td>
								</tr>
								<tr>
									<td>Total Pembayaran</td>
									<td><?php echo "Rp. " . number_format($dataPembayaran->total); ?></td>
								</tr>
								<tr>
									<td>Bukti Transaksi</td>
									<td><a href="../uploads/<?php echo $dataPembayaran->file; ?>" target="blank">Bukti Transaksi</a></td>
								</tr>
								<tr>
									<td></td>
									<td>
										<!-- jika status pending -->
										<?php
											if ($dataPembayaran->status == "pending") {
												?>
												<a href="pembayaran.php?act=verified&id=<?php echo $dataPembayaran->id; ?>&id_pesanan=<?php echo $dataPembayaran->id_pesanan; ?>" class="btn btn-sm btn-success">Verified</a>
												<?php
											}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php
				}
			}
		?>
		</div>
		</div>

		<h4>Daftar Pembayaran Masuk (<?php echo ($j>0)?$j:0; ?>)</h4>
		<a href="pembayaran.php?act=info" class="btn btn-info">Info</a>
		<hr>
		<table class="table table-striped table-hover"> 
			<thead> 
				<tr> 
					<th>No</th> 
					<th>Nama</th> 
					<th>Total</th> 
					<th>Status</th> 
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody> 
		<?php while($data=mysqli_fetch_object($q)){ ?> 
				<tr <?php if($data->status == "pending" ){ echo 'style="background:#cce9f8 !important;"'; } ?> > 
					<th scope="row"><?php echo $no++; ?></th> 
					<?php
						$katpro = $koneksi->query("select*from user where id='$data->id_user'");
								$user = mysqli_fetch_array($katpro);
					?>
					<td><?php echo $user['nama'] ?></td> 
					<td><?php echo 'Rp.' . number_format($data->total, 2,',','.') ?></td> 
					<td><?php echo $data->status ?></td> 
					<td>
						<a class="btn btn-sm btn-warning" href="pembayaran.php?act=detail&id=<?php echo $data->id ?>">Detail</a>
						<a class="btn btn-sm btn-success" href="detail_pesanan.php?id=<?php echo $data->id_pesanan ?>">Pesanan</a>
					</td> 
				</tr>
		<?php } ?>
			</tbody> 
		</table> 
    </div> <!-- /container -->
	
<?php include"inc/footer.php"; ?>