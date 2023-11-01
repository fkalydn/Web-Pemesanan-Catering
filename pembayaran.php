 <?php
	include"inc/config.php";

  if(!empty($_GET)){
    if($_GET['act'] == 'delete'){

      $q = $koneksi->query("DELETE FROM pesanan WHERE id='$_GET[id]'");
      if($q){ 
		alert("Pemesanan Anda sudah dibatalkan"); 
      	redir("pembayaran.php"); }
    }
  }

	if(empty($_SESSION['iam_user'])){
		alert("Silahkan Login dahulu");
		redir("index.php");
	}
	$user = mysqli_fetch_object($koneksi->query("SELECT*FROM user where id='$_SESSION[iam_user]'"));

	include'layout/header.php';

	$q = $koneksi->query("SELECT * FROM pesanan where user_id='$_SESSION[iam_user]' And status='belum lunas'");
	$j = mysqli_num_rows($q);
?>

<div class="col-md-9 content-menu">
<div class="col-md-12">
<?php
	if(!empty($_GET)){
			$q1 = $koneksi->query("SELECT*FROM detail_pesanan where pesanan_id='$_GET[id]'");
			$total = 0;
			$dataPesanan = mysqli_fetch_object($koneksi->query("SELECT * FROM pesanan where id='$_GET[id]'"));
			$kota = $dataPesanan->kota;
			$ongkir = $dataPesanan->ongkir;
		 while($data=mysqli_fetch_object($q1)){ ?>
					<?php

					$katpro = $koneksi->query("SELECT*FROM produk where id='$data->produk_id'");
					$p = mysqli_fetch_object($katpro);

					?>
					<?php 

					$t = $data->qty*$p->harga;
					$total += $t;

					?>
			<?php } ?>
<?php
		if($_GET['act'] == 'bayar' && $_GET['id']){
			if(!empty($_POST)){
				$gambar = md5('Y-m-d H:i:s').$_FILES['gambar']['name'];
				extract($_POST);
				$q = $koneksi->query("INSERT INTO pembayaran Values(NULL,'$_GET[id]','$_SESSION[iam_user]','$gambar','$bayar','pending','$keterangan',NOW())");
				if($q){
					$upload = move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/'.$gambar);
					if($upload){ 
					alert("Pembayaran Anda sukses"); 
					redir("pembayaran.php"); }
				}
			}

			extract($_GET);
			$pesanan = mysqli_fetch_object($koneksi->query("SELECT * FROM pesanan where id='$id'"));
			$qPembayaran = $koneksi->query("SELECT * FROM pembayaran where id_pesanan='$id' and status='verified'");
			$totalPembayaran = 0;
			while ($d = mysqli_fetch_object($qPembayaran)) {
				$totalPembayaran += $d->total;
			}
		?>
			<div class="row col-md-6">
			<form action="" method="post" enctype="multipart/form-data">
				<label>Total</label><br>
				<input type="text" class="form-control" name="total" value="<?php echo 'Rp. ' . number_format($total+$pesanan->ongkir, 2,',','.'); ?>" disabled required><br>
				<label>Dibayar</label><br>
				<input type="text" class="form-control" name="dibayar" value="<?php echo "Rp. ". number_format($totalPembayaran, 2, ",", "."); ?>" disabled required><br>
				<label>Kekurangan</label><br>
				<input type="text" class="form-control" name="kekurangan" value="<?php echo "Rp. ". number_format($total+$pesanan->ongkir-$totalPembayaran, 2, ",", "."); ?>" disabled required><br>
				<label>Bayar</label><br>
				<input type="number" class="form-control" name="bayar" required placeholder="Masukkan sesuai jumlah tagihan"><br>
				<label>Bukti Pembayaran</label><br>
				<input type="file" class="form-control" name="gambar" required><br>
				<label>Keterangan</label><br>
				<textarea class="form-control" name="keterangan" placeholder="Masukkan nama Bank yang Anda gunakan"></textarea><br/>
				<input type="submit" name="form-input" value="Kirim" class="btn btn-success">
			</form>
			</div>
			<div class="row col-md-12"><hr></div>
		<?php
		}
	}
?>
</div>
	<h3>Pembayaran Pemesanan </h3>
	<hr>
	<table class="table table-striped table-hove">
		<thead>
			<tr style="background: darkgoldenrod;">
				<th>No</th>
				<th>Nama Pemesan</th>
				<th>Tanggal Pesan</th>
				<th>Tanggal Digunakan</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
	<?php while($data=mysqli_fetch_object($q)){ ?>
			<tr <?php if($data->read == 0 ){ echo 'style="background: white !important;"'; } ?> >
				<th scope="row"><?php echo $no++; ?></th>
				<?php
					$katpro = $koneksi->query("SELECT * FROM user where id='$data->user_id'");
					$user = $katpro->fetch_array();
				?>
				<td> <?php echo $data->nama ?></td>
				<td> <?php echo substr($data->tanggal_pesan,0,10) ?></td>
				<td> <?php echo $data->tanggal_digunakan ?></td>
				<td>
					<a class="btn btn-sm btn-primary" href="pembayaran.php?act=bayar&id=<?php echo $data->id; ?>">Bayar</a>
					<a class="btn btn-sm btn-danger" href="pembayaran.php?act=delete&id=<?php echo $data->id; ?>">Batalkan</a>
				</td>
			</tr>
	<?php } ?>
		</tbody>
	</table>

</div>
<?php include"layout/footer.php"; ?>
