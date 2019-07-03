    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><a href="<?= base_url('index.php/owner')?>" class="'"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/manage')?>" class=""><i class="lnr lnr-code"></i> <span>Management User</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/masakan')?>" class="active"><i class="lnr lnr-chart-bars"></i> <span>Masakan</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/pesanan')?>" class=""><i class="lnr lnr-cog"></i> <span>Pesanan</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/laporan')?>" class=""><i class="fas fa-book"></i> <span>Laporan</span></a></li>
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
                                <h2 class="title-1">Menu</h2>
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
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Status Masakan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            foreach($mas->result_array() as $i):
                                $id_masakan = $i['id_masakan'];
                                $nama = $i['nama_masakan'];
                                $desc = $i['deskripsi'];
                                $harga = $i['harga'];
                                $gambar = $i['gambar'];
                                $kategori = $i['kategori'];
                                $smasakan = $i['status_masakan'];
                                ?>
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $nama;?></td>
                                    <td ><?php echo $desc;?></td>
                                    <td><?php echo $harga;?></td>
                                    <td><img class="img-circle" src="<?php echo base_url('assets/pelanggan/'.$gambar); ?>" width='100' height='100'/></a></td>
                                    <td style="text-align: center;"><?php echo $kategori;?></td>
                                    <td><?php echo $smasakan;?></td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#modal_edit<?php echo $id_masakan;?>" class="btn btn-info" style="border-radius: 2px;"><i class="fas fa-pencil-alt ai"></i></button>
                                        <a href="<?php echo base_url('index.php/owner/hapusmas/'.$id_masakan);?>" title="hapus"><button type="button" class="btn btn-danger" style="border-radius: 2px;"><i class="fas fa-trash-alt ai"></i></button></td>
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
                        <h3>Tambah Menu</h3> 
                    </div>
                    <div class="modal-body form">
                        <form action="<?php echo base_url('index.php/owner/gambar')?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="nama">Nama Menu</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nama_masakan" placeholder="Nama Menu" required="">
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-md-3" for="username">Deskripsi</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required="" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3" for="password">Harga</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="harga" placeholder="Harga" required="">
                                    </div>
                                </div>

                                <!-- Gambar -->
                                <div class="form-group">
                                    <label class="control-label col-md-3">Gambar</label>
                                    <div class="col-md-9">
                                        <input type="file" id="gambar" name="gambar">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Kategori</label>
                                    <div class="col-md-9">
                                        <select name="kategori" class="form-control" required="">
                                            <option value="">--Select Kategori--</option>
                                            <option name="id_level" value="1">Makanan</option>
                                            <option name="id_level" value="2">Minuman</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Status Makanan</label>
                                    <div class="col-md-9">
                                        <select name="status_masakan" class="form-control" required="">
                                            <option value="">--Select Status--</option>
                                            <option name="id_level" value="ready">Ready</option>
                                            <option name="id_level" value="belum ready">Belum Ready</option>
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
         $id_masakan = $i['id_masakan'];
         $nama = $i['nama_masakan'];
         $desc = $i['deskripsi'];
         $harga = $i['harga'];
         $gambar = $i['gambar'];
         $kategori = $i['kategori'];
         $smasakan = $i['status_masakan'];
         ?>
         <div class="modal fade" id="modal_edit<?php echo $id_masakan;?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <h3 class="modal-title" id="myModalLabel">Edit Masakan</h3>
                   </div>
                   <div class="modal-body form">
                    <form action="<?php echo base_url('index.php/owner/egambar')?>" enctype="multipart/form-data" class="form-horizontal" method="post">
                        <div class="form-body">

                            <div class="form-group" hidden>
                                <label class="control-label col-md-3" for="nama">id</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="id_masakan" placeholder="Nama Menu" required="" value="<?= $id_masakan;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="nama">Nama Menu</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nama_masakan" placeholder="Nama Menu" required="" value="<?= $nama;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="username">Deskripsi</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required="" value="<?= $desc;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="password">Harga</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="harga" placeholder="Harga" required="" value="<?= $harga;?>">
                                </div>
                            </div>

                            <!-- Gambar -->
                            <div class="form-group">
                                <label class="control-label col-md-3">Gambar</label>
                                <div class="col-md-9">
                                    <img class="img-circle" src="<?php echo base_url('assets/pelanggan/'.$gambar); ?>" width='100' height='100'/>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="password">Edit Gambar</label>
                                <div class="col-md-9">
                                    <input type="file" id="gambar" name="gambar" value="kosong">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Kategori</label>
                                <div class="col-md-9">
                                    <select name="kategori" class="form-control" required="">
                                        <option value="">--Select Kategori--</option>
                                        <?php if($kategori=='1'):?>
                                            <option value="1" selected="">Makanan</option>
                                            <option value="2">Minuman</option>
                                            <?php else:?>
                                                <option value="1">Makanan</option>
                                                <option value="2" selected>Minuman</option>
                                            <?php endif;?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Status Makanan</label>
                                <div class="col-md-9">
                                    <select name="status_masakan" class="form-control" required="">
                                        <option value="">--Select Status--</option>
                                        <?php if($smasakan=='ready'):?>
                                            <option value="ready" selected="">Ready</option>
                                            <option value="belum ready">Belum Ready</option>
                                            <?php else:?>
                                                <option value="ready">Ready</option>
                                                <option value="belum ready" selected="">Belum Ready</option>
                                            <?php endif;?>
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
    <?php endforeach; ?>
    <!-- END MAIN -->
    <div class="clearfix">
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2019. MNAC Copyright.</p>
            </div>
        </footer>
    </div>
