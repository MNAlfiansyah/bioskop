<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu</title>
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets\bootstrap4\css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets\custom.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets\number.css')?>">
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-danger fixed-top">
		<a class="navbar-brand">
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle fa-stack-2x"></i>
				<i class="fas fa-utensils fa-stack-1x fa-inverse"></i>
			</span>
		</a>
		<h3><span><?php echo $this->session->userdata("user_nama");?></span></h3>

		<div class="navbar-collapse collapse w-50 ">
			<ul class="navbar-nav w-100 justify-content-center">
				<?php
				foreach ($kategori as $row) 
				{
					?>
					<li class="nav-item">
						<a href="<?php echo base_url()?>index.php/pelanggan/index/<?php echo $row['id'];?>" class="nav-link"><h5><?php echo $row['nama_kategori'];?></h5></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<div class="navbar-collapse collapse w-10 order-1">
			<ul class="navbar-nav ml-auto">
				<form action="<?php echo base_url()?>pelanggan/ubah_cart" method="post" name="frmShopping" id="frmShopping" class="form-horizontal" enctype="multipart/form-data">
					<?php
					$cart= $this->cart->contents();

					if(empty($cart)) {
						?>
						<a hidden></a>
						<?php
					}
					else
					{
						$grand_total = 0;
						foreach ($cart as $item):
							$grand_total = $grand_total + $item['subtotal'];
							?>
						<?php endforeach; ?>
						<li class="nav-item">
							<a class="nav-link">Order Total: Rp <?php echo number_format($grand_total, 0,",","."); ?></a>
						</li>
						<?php	
					}
					?>
				</form>
			</ul>
		</div>
		<div class="navbar-collapse collapse w-80 order-3 dual-collapse2">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item ">
					<a class="nav-link" onclick="add_person()"><i class="fas fa-cart-plus fa-lg"> Cart</i></a>
				</li>
			</ul>
		</div>
	</nav>
	<br>
	<br>
	<br>
	<br>
	<div class="main">
		<div class="col-lg-12">
			<div class="row">
				<!-- MAIN CONTENT -->
				<?php
				foreach ($produk as $row) {
					?>
					<div class="col-lg-3 col-md-5 mb-3">
						<div class="kotak">
							<form method="post" action="<?php echo base_url();?>index.php/pelanggan/tambah" method="post" accept-charset="utf-8">
								<img class="img-thumbnail" src="<?php echo base_url() . 'assets/pelanggan/'.$row['gambar']; ?>"/></img>
								<div class="card-body">
									<h4 class="card-title">
										<?php echo $row['nama_masakan'];?>
									</h4>
									<h5>Rp. <?php echo number_format($row['harga'],0,",",".");?></h5>
									<p class="card-text"><?php echo $row['deskripsi'];?></p>
								</div>
								<div class="card-footer">
									<input type="hidden" name="id" value="<?php echo $row['id_masakan']; ?>" />
									<input type="hidden" name="nama" value="<?php echo $row['nama_masakan']; ?>" />
									<input type="hidden" name="harga" value="<?php echo $row['harga']; ?>" />
									<input type="hidden" name="gambar" value="<?php echo $row['gambar']; ?>" />
									<center><div class="number-input">
										<button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
										<input class="quantity" min="0" value="0" name="qty" type="number">
										<button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
									</div>

								</div>
								<button type="submit" class="btn btn-lg btn-success btn-block"><i class="fas fa-shopping-cart">Add to Cart</i></button>
							</form>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</body>

<!-- Modal -->
<div class="modal fad" id="modal_form" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h2><?php echo $this->session->userdata("user_nama");?></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form action="<?php echo base_url('index.php/admin/hakplus')?>" method="post" id="form" class="form-horizontal">
					<h3>Daftar Belanja</h3>
					<form action="<?php echo base_url()?>pelanggan/ubah_cart" method="post" name="frmShopping" id="frmShopping" class="form-horizontal" enctype="multipart/form-data">
						<?php
						if ($cart = $this->cart->contents())
						{
							?>
							<table class="table">
								<tr id= "main_heading">
									<td width="2%">No</td>
									<td width="10%">Gambar</td>
									<td width="33%">Item</td>
									<td width="15%">Harga</td>
									<td width="10%">Qty</td>
									<td width="20%">Jumlah</td>
									<td width="10%">Hapus</td>
								</tr>
								<?php
								$grand_total = 0;
								$i = 1;

								foreach ($cart as $item):
									$grand_total = $grand_total + $item['subtotal'];
									?>
									<input type="hidden" name="cart[<?php echo $item['id'];?>][id]" value="<?php echo $item['id'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][rowid]" value="<?php echo $item['rowid'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][name]" value="<?php echo $item['name'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][price]" value="<?php echo $item['price'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][gambar]" value="<?php echo $item['gambar'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][qty]" value="<?php echo $item['qty'];?>" />
									<tr>
										<td><?php echo $i++; ?></td>
										<td><img class="img-responsive" src="<?php echo base_url() . 'assets/pelanggan/'.$item['gambar']; ?>" width="100%"/></td>
										<td><?php echo $item['name']; ?></td>
										<td><?php echo number_format($item['price'], 0,",","."); ?></td>
										<td><input type="text" class="form-control input-sm" name="cart[<?php echo $item['id'];?>][qty]" value="<?php echo $item['qty'];?>" disabled/></td>
										<td><?php echo number_format($item['subtotal'], 0,",",".") ?></td>
										<td><a href="<?php echo base_url()?>index.php/pelanggan/hapus/<?php echo $item['rowid'];?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<td colspan="3"><b>Order Total: Rp <?php echo number_format($grand_total, 0,",","."); ?></b></td>
									<td colspan="4" align="right">
										<a href="<?php echo base_url()?>index.php/pelanggan/hapus/all" class='btn btn-sm btn-danger'>Kosongkan Cart</a>
										<a href="<?php echo base_url()?>index.php/pelanggan/proses_order" class ='btn btn-sm btn-primary'>Proses Order</a>
									</td>
								</tr>
							</table>
							<?php
						}
						else
						{
							echo "<h3>Keranjang Belanja masih kosong</h3>";	
						}	
						?>
					</form>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!--
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form method="post" action="<?php echo base_url()?>index.php/pelanggan/hapus/all">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					Anda yakin mau mengosongkan Shopping Cart?

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-sm btn-primary">Ya</button>
				</div>

			</form>
		</div>
	-->
	<!-- JAVASCRIPT -->
	<script src="<?= base_url('assets/dashboard/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?= base_url('assets\bootstrap4\js/bootstrap.min.js')?>"></script>
	<script src="<?= base_url('assets/bootstrap4/js/popper.js')?>"></script>
	
	<?php 
	if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
		echo '<script>alert("Pesanan Berhasil !");</script>';
	}
	$_SESSION['pesan'] = '';
	?>

	<script type="text/javascript">
		function add_person(){
			save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

$('form').on('click', 'button:not([type="submit"])', function(e){
	e.preventDefault();
})
</script>
</html>