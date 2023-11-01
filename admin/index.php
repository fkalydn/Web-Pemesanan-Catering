<?php
	include"../inc/config.php";
	validate_admin_not_login("login.php");
	include"inc/header.php";
?>

	<div class="container text-center" style="margin-top:20px;padding:50px;">

		<?php
			$q = $koneksi->query("select*from user WHere id='$_SESSION[iam_admin]'");
			$u = mysqli_fetch_object($q);
		?>
		<h2>Hallo, <?php echo $u->nama ?></h2>
		<br>
		<br>
		<h1>Selamat Datang di Halaman Web Administrator</h1><br>
		<h1>Awali dengan Bissmillah</h1><br>
		<h1>Akhiri dengan Alhamdulillah</h1>
    </div> <!-- /container -->


<?php include"inc/footer.php"; ?>
