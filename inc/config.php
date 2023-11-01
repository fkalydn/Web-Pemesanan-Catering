<?php 
	session_start();
	$koneksi=mysqli_connect("localhost", "root", "", "catering");
	
	// settings
	$url = "http://localhost/catering/";
	$title = "Pemesanan Katering (PEKAT)";
	$no = 1; 
	
	function alert($command){
		echo "<script>alert('".$command."');</script>";
	}
	function redir($command){
		echo "<script>document.location='".$command."';</script>";
	}
	function validate_admin_not_login($command){
		if(empty($_SESSION['iam_admin'])){
			redir($command);
		}
	}
?>