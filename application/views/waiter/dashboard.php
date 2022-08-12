<div id="sidebar-nav" class="sidebar ">
	<div class="sidebar-sticky">
		<nav class="sidebar">
			<ul class="nav">
				<li><a href="<?= base_url('index.php/waiter');?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?= base_url('index.php/waiter/pesanan')?>" class=""><i class="lnr lnr-cog"></i> <span>Pesanan</span></a></li>
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
									<span class="icon"><i class="fa fa-eye"></i></span>
									<p>
										<span class="number"><?= $transaksi ?></span>
										<span class="title">Pesanan </span>
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


