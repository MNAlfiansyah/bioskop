    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><a href="<?= base_url('index.php/admin')?>" class="'"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                    <li><a href="<?= base_url('index.php/admin/manage')?>" class=""><i class="lnr lnr-code"></i> <span>Management User</span></a></li>
                    <li><a href="<?= base_url('index.php/admin/masakan');?>" class=""><i class="lnr lnr-chart-bars"></i> <span>Masakan</span></a></li>
                    <li><a href="<?= base_url('index.php/admin/pesanan')?>" class="active"><i class="lnr lnr-cog"></i> <span>Pesanan</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Manajemen Pesanan</h2>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <select name="id_order" onchange="cek_data()">
                      <option value="">--- Pilih Meja ---</option>
                      <?php foreach ($pes->result() as $baris): ?>
                        <option value="<?php echo $baris->id_order; ?>"><?php echo $baris->no_meja; ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="loading"></div>
                <div class="tampilkan_data"></div>
                
                <!-- POPUP Detail -->
                <div class="modal fade" id="modal_edit" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                               <h3 class="modal-title" id="myModalLabel">Detail pesanan</h3>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           </div>
                           <div class="modal-body form">  
                            <form class="form-horizontal" method="post" action="">
                              <div class="form-body">
                                 <table class="table table-striped">
                                  <thead>
                                    <tbody id="data">
                                    </thead>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <input name="submit" type="submit" value="OK" class="btn btn-success active" style="border-radius: 2px;">
                                <button type="button" class="btn btn-danger active" style="border-radius: 2px;" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- END MAIN -->
    <div class="clearfix">
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2019. MNAC Copyright.</p>
            </div>
        </footer>
    </div>

    <script type="text/javascript">
      function get(id) {
        $.ajax({
            url:"<?php echo base_url('index.php/admin/alldata');?>",
            type:"POST",
            data:{
                kode:id
            },
            dataType:"JSON",
            success:function(result){
                $("#data").html("");
                $.each(result,function(key,value){
                  $('#data').append(`<tr>

                    <td>${value.nama_masakan}</td>
                    <td>${value.harga}</td>



                    </tr>`);
                  console.log(value.jumlah);
              })
            }
        });
    }

    function cek_data()
    {
        sel_kota = $('[name="id_order"]');
        $.ajax({
          type : 'POST',
          data: "cari="+1+"&id_order="+sel_kota.val(),
          url  : "<?php echo base_url('index.php/admin/view_data');?>",
          cache: false,
          beforeSend: function() {
            sel_kota.attr('disabled', true);
            $('.loading').html('Loading...');
        },
        success: function(data){
            sel_kota.attr('disabled', false);
            $('.loading').html('');
            $('.tampilkan_data').html(data);
        }
    });
        return false;
    }
</script>

