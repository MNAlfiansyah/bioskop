<div id="sidebar-nav" class="sidebar ">
	<div class="sidebar-sticky">
		<nav class="sidebar">
			<ul class="nav">
				<li><a href="<?= base_url('index.php/admin');?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?= base_url('index.php/admin/manage');?>" class=""><i class="lnr lnr-code"></i> <span>Management User</span></a></li>
				<li><a href="<?= base_url('index.php/admin/buku');?>" class=""><i class="lnr lnr-chart-bars"></i> <span>Film</span></a></li>
				<li><a href="<?= base_url('index.php/admin/pesanan')?>" class=""><i class="lnr lnr-cog"></i> <span>Studio</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<!----------INDEX---------->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-download"></i></span>
									<p>
										<span class="number"><?= $user ?></span>
										<span class="title">Total User</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-shopping-bag"></i></span>
									<p>
										<span class="number"><?= $masakan ?></span>
										<span class="title">Total Menu</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-eye"></i></span>
									<p>
										<span class="number"><?= $transaksi ?></span>
										<span class="title">Total Peminjam</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 10120918 - Dennie Fuzi Alfiyanies </p>
			</div>
		</footer>
	</div>
</div>


