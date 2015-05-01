<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Semua Materi</title>

   <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
	<!-- DataTable css -->
    <link href="<?= base_url('assets/css/dataTables.bootstrap.css');?>" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php $this->load->view('include/menu_home'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Semua Materi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Data Semua Materi | Semester: <span class="badge badge-success"><?= $semester; ?></span> | Tahun Pelajaran: <span class="badge badge-success"><?= $thnajaran; ?></span></strong>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
							<table id="tabel-semua-materi" class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Materi</th>
										<th>Deskripsi</th>
										<th>Kelas</th>
										<th>Pelajaran</th>
										<th>Pengajar</th>
										<th>Tanggal</th>
										<th>File</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									foreach($semuaMateri as $materi_data) {?>
									<tr>
										<td><?php echo $no = $no+1; ?></td>
										<td><?php echo $materi_data->materi_nama; ?></td>
										<td><?php echo $materi_data->materi_deskripsi; ?></td>
										<td><?php echo $materi_data->kelas_nama." ".$materi_data->jurusan_nama." ".$materi_data->kelas_no; ?></td>
										<td><?php echo $materi_data->pelajaran_nama; ?></td>
										<td><?php echo $materi_data->pengajar_nama; ?></td>
										<td><?php echo $materi_data->materi_tanggal; ?></td>
										<td><a href="<?php echo base_url('assets/uploads').'/'.$materi_data->materi_file; ?>"><i class="fa fa-download"></i></a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table></div>
						</div><!-- /.panel-body -->
					</div><!-- /.panel -->
				</div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
    
    <?= $dataTable; ?>
    <?= $validasi; ?>
    
    <script>
    // tooltip demo
    $('.form-group').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>
</body>

</html>
