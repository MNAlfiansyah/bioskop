    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><a href="<?= base_url('index.php/owner')?>" class="'"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/manage')?>" class="active"><i class="lnr lnr-code"></i> <span>Management User</span></a></li>
                    <li><a href="<?= base_url('index.php/owner/masakan');?>" class=""><i class="lnr lnr-chart-bars"></i> <span>Masakan</span></a></li>
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
                                <h2 class="title-1">Manajemen User</h2>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                    if (isset($error)){
                        echo $error;
                    }
                    ?>
                    <button type="button" class="btn btn-success" onclick="add_person()"><i class="fas fa-plus"></i> Tambah</button>
                    <br><br>
                    <table id="table_id" class="table table-striped " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Username</th>
                                <th style="text-align: center;">Password</th>
                                <th style="text-align: center;">Nama User</th>
                                <th style="text-align: center;">Level</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            foreach($cek->result_array() as $i):
                                $id=$i['id_user'];
                                $username=$i['username'];
                                $password=$i['password'];
                                $nama=$i['nama_user'];
                                $lvl=$i['id_level'];
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $no++;?></td>
                                    <td style="text-align: center;"><?php echo $username;?></td>
                                    <td style="text-align: center;"><?php echo $password;?></td>
                                    <td style="text-align: center;"><?php echo $nama;?></td>
                                    <td style="text-align: center;"><?php echo $lvl;?></td>
                                    <td style="text-align: center;"><button type="button" data-toggle="modal" data-target="#modal_edit<?php echo $username?>" class="btn btn-info" style="border-radius: 2px;"><i class="fas fa-pencil-alt ai"></i></button>
                                        <a href="<?php echo base_url('index.php/owner/hapususer/'.$id);?>" title="hapus"><button type="button" class="btn btn-danger" style="border-radius: 2px;"><i class="fas fa-trash-alt ai"></i></button></a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
    <!-- POPUP TAMBAH -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Tambah Anggota</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form">
                    <form action="<?php echo base_url('index.php/owner/hakplus')?>" method="post" id="form" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="nama">Nama User</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nama_user" placeholder="Nama" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="username">Username</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="password">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" placeholder="password" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Akses</label>
                                <div class="col-md-9">
                                    <select name="id_level" class="form-control" required="">
                                        <option value="">--Select akses--</option>
                                        <option name="id_level" value="1">owner</option>
                                        <option name="id_level" value="2">Waiter</option>
                                        <option name="id_level" value="3">Kasir</option>
                                        <option name="id_level" value="5">Pelanggan</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
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
    <!-- POPUP EDIT -->
    <?php
    foreach($cek->result_array() as $i):
       $id=$i['id_user'];
       $username=$i['username'];
       $password=$i['password'];
       $nama=$i['nama_user'];
       $lvl=$i['id_level'];
       ?>
       <div class="modal fade" id="modal_edit<?php echo $username ?>" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <h3 class="modal-title" id="myModalLabel">Edit Anggota</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body form">
                <form action="<?php echo base_url('index.php/owner/edituser')?>" class="form-horizontal" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3" for="nama">Username</label>
                            <div class="col-md-9">
                                <input type="text" value="<?php echo $username;?>" class="form-control" name="username" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="username">Password</label>
                            <div class="col-md-9">
                                <input type="text" value="<?php echo $password;?>"  class="form-control" name="password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="password">Nama User</label>
                            <div class="col-md-9">
                                <input type="text" value="<?php echo $nama;?>" class="form-control" name="nama_user" required="">
                                <input type="hidden" value="<?php echo $id;?>" class="form-control" name="id_user" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="password">Level</label>
                            <div class="col-md-9">
                                <input type="text" value="<?php echo $lvl;?>" class="form-control" name="id_level" required="">
                            </div>
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
<?php endforeach; ?>
<!-- END MAIN -->
<div class="clearfix">
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; 2019. MNAC Copyright.</p>
        </div>
    </footer>
</div>


