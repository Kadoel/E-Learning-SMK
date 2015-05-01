<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pesan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/plugins/metisMenu/metisMenu.min.'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
    <!-- DataTable css -->
    <link href="<?= base_url('assets/css/dataTables.bootstrap.css');?>" rel="stylesheet" />
    
    <script src="<?= base_url('assets/plugins/alertify/alertify.min.js');?>"></script>
	<!-- include the style -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/alertify/css/alertify.min.css');?>" />
	<!-- include a theme -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/alertify/css/themes/default.min.css');?>" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php $this->load->view('include/menu_admin'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pesan</h1>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
					<button class="btn btn-primary btn-outline btn-md" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-edit"></i> Tulis Pesan
					</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel"><strong>Pesan Baru</strong></h4>
                            </div>
                            <div class="modal-body">
								<span id="warning"></span>
								<?php
								$attform = array(
										'id' => 'form-tulis-pesan',
										'role' => 'form'
									);
								echo form_open('admin/pesan/act_pesan', $attform);
								?>
									<div class="form-group">
										<label>Untuk</label>
										<select class="form-control" name="pesan_untuk" data-validation="required" data-validation-error-msg="Silahkan Pilih Penerima" data-toggle="tooltip" data-placement="top" title="Silahkan Pilih Penerima">
											<?php
											echo'<option value="">-- Pilih Penerima --</option>';
											foreach($listPengajar as $jrs){
												echo '<option value="'.$jrs->pengajar_id.'"';
													if($jrs->pengajar_id == $this->session->userdata('user_id')){
														echo ' hidden';
													}
												echo '>'.$jrs->pengajar_nama.'</option>';
												echo form_error('pesan_untuk');
											}
											?>
										</select>
									</div>
									
									<div class="form-group">
										<label>Subjek</label>
										<?php $att = array('class'=>'form-control', 
												'name'=>'pesan_judul', 
												'placeholder'=>'Masukkan Subjek Pesan',
												'data-validation'=>'required',
												'data-validation-error-msg'=>'Silahkan isi Subjek Pesan',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan Secara Singkat ");
										echo form_input($att);
										echo form_error('pesan_judul'); ?>
									</div>
									
									<div class="form-group">
										<label>Pesan</label>
										<?php $attbalas = array('class'=>'form-control', 
												'name'=>'pesan_isi',
												'placeholder'=>'Masukkan Pesan',
												'data-validation'=>'required',
												'data-validation-error-msg'=>'Silahkan Tulis Balasan Pesan Anda',
												'style'=>'min-height:110px; height:100px; max-height:150px; min-width:100%; max-width:100%; width:100%;',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan Balasan Pesan Anda, Bisa Dengan Tag HTML (<br>, <p>, <a>, Dll"
												);
										echo form_textarea($attbalas);
										echo form_error('pesan_isi'); ?>
									</div>
										
                            </div>
                            <div class="modal-footer">
                                <?php 
								$attsubmit = array(
										'class'=>'btn btn-md btn-outline btn-primary',
										'id'=>'btn-pesan',
										'name'=>'btn-pesan',
										'type'=>'submit',
										'content'=>'<i class="fa fa-save"></i> Kirim'); 
								echo form_button($attsubmit); 
								?>
								<img src="<?= base_url()?>assets/images/ajax-loader.gif" id="LoadingImage" style="display:none; width:50px; height:50px;" />
								</form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div><!-- /.row --> 
            <br />
            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Daftar Pesan</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#masuk" data-toggle="tab">Masuk</a>
                                </li>
                                <li><a href="#terkirim" data-toggle="tab">Terkirim</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="masuk">
                                    <div class="table-responsive">
										<table id="tabel-pesan-masuk" class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Dari</th>
													<th>Subjek</th>
													<th>Waktu</th>
													<th>Kontrol</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 0;
												foreach($pesanMasuk as $masuk) {?>
												<tr>
													<td><h5><?php echo $no = $no+1; ?></h5></td>
													<td><?php
														if($masuk->pesan_status == '0'){
															echo "<h5><a href='".base_url('admin/pesan/baca/'.$masuk->pesan_id)."'><b>[Baru]</b> ".$masuk->pengajar_nama."</a></h5>";
														}
														else{
															echo "<h5>".$masuk->pengajar_nama."</h5>";
														} 
														?>
													</td>
													<td><?php
														if($masuk->pesan_status == '0'){
															echo "<h5><a href='".base_url('admin/pesan/baca/'.$masuk->pesan_id)."'>".$masuk->pesan_judul."</a> <small>".substr($masuk->pesan_isi, 0, 50)."</small></h5>";
														}
														else{
															echo "<h5>".$masuk->pesan_judul." <small>".substr($masuk->pesan_isi,0,50)."...</small></h5>";
														} 
														?>
													</td>
													<td><h5><?= $masuk->pesan_tanggal ?></h5></td>
													<td>
														<a href="<?= base_url('admin/pesan/baca/'.$masuk->pesan_id)?>">
															<i class="fa fa-eye"></i>
														</a>&nbsp;
														<a href="<?php echo site_url('admin/pesan/hapus_masuk/'.$masuk->pesan_id);?>" class="hapus-pesan-masuk">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
                                </div>
                                <div class="tab-pane fade" id="terkirim">
                                    <div class="table-responsive">
										<table id="tabel-pesan-kirim" class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Untuk</th>
													<th>Subjek</th>
													<th>Waktu</th>
													<th>Kontrol</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 0;
												foreach($pesanTerkirim as $kirim) {?>
												<tr>
													<td><h5><?php echo $no = $no+1; ?></h5></td>
													<td><h5><?= $kirim->pengajar_nama; ?></h5></td>
													<td><h5><?php echo $kirim->pesan_judul." <small>".substr($kirim->pesan_isi, 0, 50)."...</small>"; ?></h5></td>
													<td><h5><?= $kirim->pesan_tanggal ?></h5></td>
													<td>
														<a href="<?= base_url('admin/pesan/baca/'.$kirim->pesan_id)?>">
															<i class="fa fa-eye"></i>
														</a>&nbsp;
														<a href="<?php echo site_url('admin/pesan/hapus_kirim/'.$kirim->pesan_id);?>" class="hapus-pesan-kirim">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div><!-- /.row -->
        </div><!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?= base_url('assets/js/jquery-1.11.0.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url('assets/plugins/metisMenu/metisMenu.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url('assets/js/sb-admin-2.js');?>"></script>
    
    <script src="<?= base_url('assets/plugins/validasi/jquery.form-validator.js');?>"></script>
    
     <!-- DataTable js -->
    <script src="<?= base_url('assets/plugins/dataTables/jquery.dataTables.js');?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/plugins/dataTables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
    
    <?php
    echo $datatableMasuk;
    echo $datatableKirim;
    echo $hapusdataMasuk;
    echo $hapusdataKirim;
    echo $kirimdata;
    echo $validasi;
    ?>
    
    <script>
    // tooltip demo
    $('.form-group').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>

</body>

</html>

