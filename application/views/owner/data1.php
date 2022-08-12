<section class="content">
 <div class="row">
   <div class="col-md-7">
     <div class="box box-success">
       <div class="box-header with-border">
         <h3 class="bordercool">Point Of Sale</h3>
       </div><!--./ box header-->
       <div class="box-body">
         <div class="box-body table-responsive no-padding">
           <table id="table_transaction" class="table  table-bordered table-hover ">
             <thead>
               <tr class="tableheader">
                 <th style="width:40px">#</th>
                 <th style="width:60px">Id Transaksi</th>
                 <th style="width:250px">No Meja</th>
                 <th style="width:120px">Id Order</th>
                 <th style="width:120px">Total Bayar</th>
               </tr>
             </thead>
             <tbody>
              <?php 
              $total_harga2 = 0;
              $no = 1;
              foreach($lapor->result_array() as $i){
                $id_t = $i['id_transaksi'];
                $tgl = $i['tanggal'];
                $id = $i['id_order'];
                $meja = $i['no_meja'];
                $t_bayar = $i['total_bayar'];
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $no++;?></td>
                  <td style="text-align: center;"><?php echo $id_t;?></td>
                  <td style="text-align: center;"><?php echo $meja;?></td>
                  <td style="text-align: center;"><?php echo $id;?></td>
                  <td style="text-align: center;"><?php echo $t_bayar;?></td>
                </td>
              </tr>
              <?php 
              $total_harga2 +=$i['total_bayar'];
            } 
            ?>
          </tbody>
        </table>
      </div> 
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col-md-8 -->

<div class="col-md-5">
 <div class="box-header with-border">
 </div><!--./ box header-->
 <div class="box-body">
   <div class="form-horizontal">
     <div class="box-body">
       <div class="form-group">   
         <label class="col-sm-3  control-label">Date Order.</label>   
         <div class="col-sm-9">
           <input readonly="" type="text" class="form-control txtsalesdate" id="txtsalesdate"  value="<?= $tgl ?>" >
         </div>
       </div>
       <div class="form-group">   
         <label class="col-sm-3  control-label">Total.</label>   
         <div class="col-sm-9">
          <input readonly="" type="text" class="form-control txtsalesdate" id="txtsalesdate"  value="<?= $total_harga2?>" >
        </div>
      </div>
    </div>
  </div>
  <div class="form-horizontal">
   <div class="box-body">
     <div class="form-group">
       <label class="col-sm-12" control-label="">
         <button type="button"  data-toggle="modal" data-target="#modal_edit<?php echo $id;?>" class="btn btn-primary btn-success btn-block btnpayment" id="btnpayment" >
           <i class="fas fa-print"></i> Cetak
         </button>
       </label>  
     </div>
   </div>
 </div> 
</div>
<!-- /.box-body -->
</div><!-- /.box -->


<?php 
$no = 1;
foreach($lapor->result_array() as $i){
  $id_t = $i['id_transaksi'];
  $tgl = $i['tanggal'];
  $id = $i['id_order'];
  $meja = $i['no_meja'];
  $t_bayar = $i['total_bayar'];
}
?>
<div class="modal fade" id="modal_edit<?php echo $id;?>" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Data Akan Dicetak !!!</h3>
      </div>
      <div class="modal-body form">
        <!-- <form action="<?php echo base_url('index.php/owner/cetak')?>" class="form-horizontal" method="post"> -->
          <div class="form-body"><center>
            <input type="hidden" name="id_transaksi" value="<?= $id_t;?>">
            <input type="hidden" name="tanggal" value="<?= $tgl;?>">
            <input type="hidden" name="id_order" value="<?= $id;?>">
            <input type="hidden" name="no_meja" value="<?= $meja;?>">
            <input type="hidden" name="total_bayar" value="<?= $t_bayar;?>">
            <input name="submit" type="submit" onclick="cek_data2()" value="Process" class="btn btn-success btn-lg btn-block" style="border-radius: 4px;">
            <button type="button" class="btn btn-danger btn-lg btn-block" style="border-radius: 4px;" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
</div>
</div><!-- /.col-md-4 -->
</div><!-- /.row -->
</section><!-- /.content -->
<!-- POPUP EDIT -->



