    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <!-- <li><a href="<?= base_url('index.php/owner')?>" class="'"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li> -->
                    <li><a href="<?= base_url('index.php/owner/manage')?>" class=""><i class="lnr lnr-code"></i> <span>Management User</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/masakan');?>" class=""><i class="lnr lnr-chart-bars"></i> <span>Masakan</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/pesanan')?>" class=""><i class="lnr lnr-cog"></i> <span>Pesanan</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/laporan')?>" class="active"><i class="fas fa-book"></i> <span>Laporan</span></a></li>
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
                                <h2 class="title-1">Manajemen Laporan</h2>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <select name="tanggal">
                        <option value="">--- Pilih Tanggal Awal ---</option>
                        <?php foreach ($lap->result() as $baris){ ?>
                            <option value="<?php echo $baris->tanggal; ?>"><?php echo $baris->tanggal; ?></option>
                        <?php }; ?>
                    </select>
                    <select name="tanggal1" onchange="cek_data()">
                        <option value="">--- Pilih Tanggal Akhir ---</option>
                        <?php foreach ($lap->result() as $baris){ ?>
                            <option value="<?php echo $baris->tanggal; ?>"><?php echo $baris->tanggal; ?></option>
                        <?php }; ?>
                    </select>

                    <div class="loading"></div>
                    <div class="tampilkan_data"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- END MAIN -->
    <div class="clearfix">
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 10120918 - Dennie Fuzi Alfiyanies </p>
            </div>
        </footer>
    </div>

    <script type="text/javascript">
      function get(id) {
        $.ajax({
            url:"<?php echo base_url('index.php/owner/alldata');?>",
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
        sel_kota = $('[name="tanggal"');
        sel_kota1 = $('[name="tanggal1"');
        $.ajax({
          type : 'POST',
          data: "cari="+1+"&tanggal="+sel_kota.val()+"&tanggal1="+sel_kota1.val(),
          url  : "<?php echo base_url('index.php/owner/view_lapor');?>",
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

    
  
  function cek_data2()  
    {
        sel_kota = $('[name="tanggal"');
        sel_kota1 = $('[name="tanggal1"');
        sel_kota2 = $('[name="id_transaksi"');
        sel_kota3 = $('[name="id_order"');
        sel_kota4 = $('[name="no_meja"');
        sel_kota5 = $('[name="total_bayar"');

        $.ajax({
          type : 'POST',
          data: "cari="+1+"&tanggal="+sel_kota.val()+"&tanggal1="+sel_kota1.val()+"&id_transaksi="+sel_kota2.val()+"&id_order="+sel_kota3.val()+"&no_meja="+sel_kota4.val()+"&total_bayar="+sel_kota5.val(),
          url  : "<?php echo base_url('index.php/owner/laporanpenjualan');?>",
      });
        return false;
    }
</script>

