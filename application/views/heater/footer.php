<!--JavaScript-->
<script src="<?= base_url('assets/dashboard/jquery-3.3.1.js')?>"></script>
<script src="<?= base_url('assets/dashboard/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/dashboard/vendor/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?= base_url('assets/dashboard/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')?>"></script>
<script src="<?= base_url('assets/dashboard/vendor/chartist/js/chartist.min.js')?>"></script>
<script src="<?= base_url('assets/dashboard/scripts/klorofil-common.js')?>"></script>
<!-- datatable -->
<script src="<?php echo base_url('assets/datatable/js/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript">
	function add_person(){
		save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
}
</script>

<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable();
	} );
</script>
</body>
</html>
