<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jurusan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
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
                    <h1 class="page-header">Jurusan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Form Jurusan</strong>
                        </div>
                        <div class="panel-body">
							<span id="warning"></span>
                            <?php
							$attform = array(
									'id' => 'form-jurusan',
									'role' => 'form'
								);
							echo form_open('admin/jurusan/act_jurusan', $attform);
							?>
								<input type="hidden" name="jurusan_id" value="<?php echo $idJurusan; ?>">
								<div class="form-group">
									<label>Nama Jurusan</label>
                                    <?php $att = array('class'=>'form-control', 
											'name'=>'jurusan_nama', 
											'value'=>$namaJurusan,
											'placeholder'=>'Masukkan Nama Jurusan',
											'data-validation'=>'required',
											'data-validation-error-msg'=>'Silahkan isi Nama Jurusan');
									echo form_input($att);
									echo form_error('jurusan_nama'); ?>
								</div>
								<?php 
								$attsubmit = array(
										'class'=>'btn btn-md btn-success',
										'id'=>'btn-jurusan',
										'name'=>'btn-jurusan',
										'type'=>'submit',
										'content'=>'Simpan'); 
								echo form_button($attsubmit); 
								?>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-8">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Data Jurusan</strong>
                        </div>
                        <div class="panel-body">
							<table id="tabel-jurusan" class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Jurusan</th>
										<th>Kontrol</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									foreach($listJurusan as $jurusan_data) {?>
									<tr>
										<td><?php echo $no = $no+1; ?></td>
										<td><?php echo $jurusan_data->jurusan_nama; ?></td>
										<td>
											<a href="<?php echo site_url('admin/jurusan/edit/'.$jurusan_data->jurusan_id);?>">
												<i class="fa fa-pencil"></i>
											</a>&nbsp;
											<a href="<?php echo site_url('admin/jurusan/hapus/'.$jurusan_data->jurusan_id);?>" class="hapus-jurusan">
												<i class="fa fa-times"></i>
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?= base_url('assets/js/jquery-1.11.0.js');?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>

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
    echo $datatable;
    echo $validasi;
    echo $kirim;
    echo $hapusdata;
    ?>
    
    Page rendered in <strong>{elapsed_time}</strong> seconds.
</body>

</html>

