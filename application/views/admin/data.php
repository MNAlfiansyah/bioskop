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
                                   <th style="width:60px">Nama Masakan</th>
                                   <th style="width:250px">Harga</th>
                                   <th style="width:120px">Qty</th>
                               </tr>
                           </thead>
                           <tbody><?php 
                           $total_harga2 = 0;
                           $no = 1;
                           foreach($pesan->result_array() as $i){
                            $id_d = $i['id_detail_order'];
                            $tgl = $i['tanggal'];
                            $id = $i['id_order'];
                            $meja = $i['no_meja'];
                            $status = $i['keterangan'];
                            $nama_mas = $i['nama_masakan'];
                            $harga = $i['harga'];
                            $qty = $i['qty'];
                            
                            ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $no++;?></td>
                                <td style="text-align: center;"><?php echo $nama_mas;?></td>
                                <td style="text-align: center;"><?php echo $harga;?></td>
                                <td style="text-align: center;"><?php echo $qty;?></td>
                            </td>
                        </tr>
                        <?php 
                        $total_harga2 +=$i['total_harga'];
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
                   <label class="col-sm-3  control-label">ID Order.</label>   
                   <div class="col-sm-9">
                       <input readonly="" type="text" class="form-control txtsalesdate" id="txtsalesdate"  value="<?= $id ?>" >
                   </div>
               </div>
               <div class="form-group">   
                   <label class="col-sm-3  control-label">Date Order.</label>   
                   <div class="col-sm-9">
                       <input readonly="" type="text" class="form-control txtsalesdate" id="txtsalesdate"  value="<?= $tgl ?>" >
                   </div>
               </div>
               <div class="form-group">  
                   <label class="col-sm-3  control-label">Sub Total</label> 
                   <div class="col-sm-9">
                       <div class="input-group">
                           <span class="input-group-addon">Rp.</span>
                           <input type="text" class="form-control " id="txtsubtotal"  value="<?= $total_harga2 ?>"  disabled>
                       </div>   
                   </div>  
               </div>
           </div>
       </div>
       <div class="form-horizontal">
           <div class="box-body">
               <div class="form-group">
                   <label class="col-sm-12" control-label="">
                       <button type="button" data-toggle="modal" data-target="#modal_edit<?php echo $id;?>" class="btn btn-primary btn-success btn-block btnpayment" id="btnpayment" >
                           <i class="fa fa-shopping-cart"></i> Process Payment
                       </button>
                   </label>  
               </div>
           </div>
       </div> 
   </div>
   <!-- /.box-body -->
</div><!-- /.box -->



<?php 
$total_harga2 = 0;
$no = 1;
foreach($pesan->result_array() as $i){
    $id_d = $i['id_detail_order'];
    $tgl = $i['tanggal'];
    $id = $i['id_order'];
    $meja = $i['no_meja'];
    $status = $i['keterangan'];
    $nama_mas = $i['nama_masakan'];
    $harga = $i['harga'];
    $qty = $i['qty'];
    $total_harga2 +=$i['total_harga'];
}
?>
    <div class="modal fade" id="modal_edit<?php echo $id;?>" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Apakah pesanan sudah benar ? </h3>
                </div>
                <div class="modal-body form">
                    <form action="<?php echo base_url('index.php/admin/s_pesanan')?>" class="form-horizontal" method="post">
                        <div class="form-body"><center>
                            <input type="hidden" name="total_bayar" value="<?= $total_harga2;?>">
                            <input type="hidden" name="tanggal" value="<?= $tgl;?>">
                            <input type="hidden" name="id_order" value="<?= $id;?>">
                            <input type="hidden" name="no_meja" value="<?= $meja;?>">
                            <input type="hidden" name="nama_masakan" value="<?= $nama_mas;?>">
                            <input type="hidden" name="total_harga" value="<?= $total_harga2;?>">
                            <input type="hidden" name="qty" value="<?= $qty;?>">
                            <input type="hidden" name="harga" value="<?= $harga;?>">
                            <input name="submit" type="submit" value="Process" class="btn btn-success btn-lg btn-block" style="border-radius: 4px;">
                            <button type="button" class="btn btn-danger btn-lg btn-block" style="border-radius: 4px;" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div><!-- /.col-md-4 -->
</div><!-- /.row -->
</section><!-- /.content -->
<!-- POPUP EDIT -->

