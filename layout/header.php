<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $url ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/bootstrap/css/datetimepicker.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo $url ?>assets/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/full-slider.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/style.css" rel="stylesheet">

  </head>
  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-blue">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#">Pemesanan Katering (PEKAT)</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse"> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $url ?>">Beranda</a></li>
            <li><a href="<?php echo $url ?>menu.php">Menu Katering</a></li>  
            <li><a href="<?php echo $url ?>info.php">Info Pembayaran</a></li> 
            <?php if(!empty($_SESSION['iam_user'])){ ?>
			<?php 
				$user = mysqli_fetch_object($koneksi->query("SELECT*FROM user where id='$_SESSION[iam_user]'"));
			?>
            <li><a href="<?php echo $url ?>pembayaran.php">Pembayaran</a></li>      
			      <li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hallo,<?php echo $user->nama; ?> <span class="caret"></span></a>
               <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>profile.php">Profil</a></li> 
                <li><a href="<?php echo $url ?>logout.php">Logout</a></li>  
              </ul>
            </li>
			<?php }else{ ?>
			     <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login/Register <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $url ?>login.php">Login</a></li> 
                  <li><a href="<?php echo $url ?>register.php">Register</a></li>  
                </ul>
          </li>
			<?php } ?>
			

          </ul>
        </div>
      </div>
    </nav>

   <?php if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] == $url.'index.php'){ ?>
    <div class="container">

     <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li> 
        </ol>

        <!-- Wrapper for Slides -->
          <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/ikan.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Pilihan Katering Terbaik</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/cake.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Kami ada untuk Anda</h2>
                </div>
            </div> 
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
    </div> <!-- /container -->
   <?php } ?>
	
	<div class="container" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-3">
			<div style="background: darkgoldenrod; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px;">
			<h4>Kategori Menu</h4>
			</div>
			<ul class="kategori">
				<?php 
					$kategori = $koneksi->query("SELECT * FROM kategori_produk"); 
					while($data = $kategori->fetch_array()){
				?>
					<li><a href="<?php echo $url; ?>menu.php?kategori=<?php echo $data['id'] ?>"><?php echo $data['nama']; ?> (
					<?php 
						$ck = mysqli_num_rows($koneksi->query("SELECT * FROM produk WHERE kategori_produk_id='$data[id]'"));
						if($ck > 0){ echo $ck; }else{ echo 0; } ?>
					)</a></li>
				<?php } ?>
			</ul>

      <!-- Keranjang -->
			<div style="background:darkgoldenrod; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; margin-bottom:15px;">
				<h4>Keranjang Belanja</h4>
			</div>
			<div style=" width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px; border: 3px dotted darkgoldenrod;">
			
			<?php
                            if(isset($_SESSION['cart'])){
                                $total = 0;
                                $cart = unserialize($_SESSION['cart']);
                                if($cart == ''){
                                    $cart = [];
                                }
                                foreach($cart as $id => $qty){
                                    $product = mysqli_fetch_array($koneksi->query("select * from produk WHERE id='$id'"));
                                    if(isset($product)){
                                       $t = $qty * $product['harga'];
                                       $total += $t;
                                    }
                                }
                                echo '<h4 style="color:#f00;">Rp '. number_format($total, 2, ',', '.') .'</h4>';
                            }else{
                                echo '<h4 style="color:#f00;">Rp 0,00</h4>';
                            }
                                
                        ?>
				
				<a href="<?php echo $url; ?>keranjang.php">Lihat Detail</a>
			</div>
			<div class="row col-md-12">
					
			</div>
			<div class="row col-md-12">
				<hr>
      <h5><strong>Hubungi Kami disini</strong></h5>
			<a href="https://api.whatsapp.com/send?phone=6289608375792&amp;text=Halo%20admin,%20Saya%20mau%20Tanya....."><img src="<?php echo $url.'assets/img/wa.jpg'; ?>" width="70%"></a><br><br>
			</div>
		</div>