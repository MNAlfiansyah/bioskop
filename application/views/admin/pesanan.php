    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <!-- <li><a href="<?= base_url('index.php/admin')?>" class="'"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li> -->
                    <li><a href="<?= base_url('index.php/admin/manage')?>" class=""><i class="lnr lnr-code"></i> <span>Management User</span></a></li>
                    <li><a href="<?= base_url('index.php/admin/pesanan')?>" class="active"><i class="lnr lnr-camera-video"></i> <span>Auditorium</span></a></li>
                    <li><a href="<?= base_url('index.php/admin/buku')?>" class=""><i class="lnr lnr-film-play"></i> <span>Film</span></a></li>
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
                                <h2 class="title-1">Auditorium</h2>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div style="color: red;"><?php echo (isset($message))? $message : ""; ?></div>
                    <button type="button" class="btn btn-success" onclick="add_person()"><i class="fas fa-plus"></i> Tambah</button>
                    <br><br>
                    <table id="table_id" class="table table-striped " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <!-- <th>Tanggal</th> -->
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            foreach($mas->result_array() as $i):
                                $id_order = $i['id_order'];
                                $nama = $i['no_meja'];
                                // $tanggal = $i['tanggal'];
                                $id_user = $i['id_user'];
                                $ket = $i['keterangan'];
                                $status = $i['status_order'];
                                ?>
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $nama;?></td>
                                    <!-- <td ><?php echo $tanggal;?></td> -->
                                    <td><?php echo $ket;?></td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#modal_edit<?php echo $id_order;?>" class="btn btn-info" style="border-radius: 2px;"><i class="fas fa-pencil-alt ai"></i></button>
                                        <a href="<?php echo base_url('index.php/admin/hapus_order/'.$id_order);?>" title="hapus"><button type="button" class="btn btn-danger" style="border-radius: 2px;"><i class="fas fa-trash-alt ai"></i></button></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>
        </div>
        <!-- POPUP TAMBAH -->
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Tambah Auditorium</h3>
                    </div>
                    <div class="modal-body form">
                        <form action="<?php echo base_url('index.php/admin/addPesanan')?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="nama">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="no_meja" placeholder="Nama" required="">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3" for="username">Tanggal</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required="" >
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3">Keterangan</label>
                                    <div class="col-md-9">
                                        <select name="keterangan" class="form-control" required="">
                                            <option value="">--Select Keterangan--</option>
                                            <option name="keterangan" value="airing">Airing</option>
                                            <option name="keterangan" value="selesai">Selesai</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input name="submit" type="submit" value="Simpan" class="btn btn-success active" style="border-radius: 2px;">
                                    <button type="button" class="btn btn-danger active" style="border-radius: 2px;" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- POPUP EDIT -->
        <?php
        foreach($mas->result_array() as $i):
            $id_order = $i['id_order'];
            $nama = $i['no_meja'];
            $tanggal = $i['tanggal'];
            $id_user = $i['id_user'];
            $ket = $i['keterangan'];
            $status = $i['status_order'];
        ?>
         <div class="modal fade" id="modal_edit<?php echo $id_order;?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <h3 class="modal-title" id="myModalLabel">Edit Auditorium</h3>
                   </div>
                   <div class="modal-body form">
                    <form action="<?php echo base_url('index.php/admin/editPesanan')?>" enctype="multipart/form-data" class="form-horizontal" method="post">
                        <div class="form-body">

                            <div class="form-group" hidden>
                                <label class="control-label col-md-3" for="nama">id</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="id_order" placeholder="Nama Auditorium" required="" value="<?= $id_order;?>">
                                </div>
                            </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3" for="nama">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="no_meja" placeholder="Nama" required="" value="<?= $nama;?>">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3" for="username">Tanggal</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required="" value="<?= $tanggal;?>">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3">Keterangan</label>
                                    <div class="col-md-9">
                                        <select name="keterangan" class="form-control" required="">
                                        <option value="">--Select Keterangan--</option>
                                        <?php if($ket=='airing'):?>
                                            <option name="keterangan" value="airing" selected="">Airing</option>
                                            <option name="keterangan" value="selesai">Selesai</option>
                                            <?php else:?>
                                                <option name="keterangan" value="airing">Airing</option>
                                                <option name="keterangan" value="selesai" selected>Selesai</option>
                                            <?php endif;?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input name="submit" type="submit" value="submit" class="btn btn-success active" style="border-radius: 2px;">
                                    <button type="button" class="btn btn-danger active" style="border-radius: 2px;" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- END MAIN -->
    <div class="clearfix">
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 10120918 - Dennie Fuzi Alfiyanies </p>
            </div>
        </footer>
    </div>
