<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Baca Pesan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/plugins/metisMenu/metisMenu.min.'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
    <?php
    if($datapesan->pesan_dari != $this->session->userdata('user_id')){?>    
		<script src="<?= base_url('assets/plugins/alertify/alertify.min.js');?>"></script>
		<!-- include the style -->
		<link rel="stylesheet" href="<?= base_url('assets/plugins/alertify/css/alertify.min.css');?>" />
		<!-- include a theme -->
		<link rel="stylesheet" href="<?= base_url('assets/plugins/alertify/css/themes/default.min.css');?>" />
	<?php }?>

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
            <br>
            <!-- /.row -->
           <div class="row">
			   <div class="col-lg-12">
				   <div class="panel panel-primary">
						<div class="panel-heading">
							<strong><?= $datapesan->pesan_judul; ?></strong>
						</div>
						<div class="panel-body">
							<pre><b>Dari    :</b> <?= $datapesan->dari; ?><br><b>Untuk   :</b> <?= $datapesan->untuk; ?><br><br><b>Tanggal :</b> <?= $datapesan->pesan_tanggal; ?></pre>
							<pre><?= $datapesan->pesan_isi; ?></pre>
						</div>
					</div>
				</div>
            </div>
            <?php if($datapesan->pesan_dari != $this->session->userdata('user_id')){?>
            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Balas Cepat</strong>
                        </div>
                        <div class="panel-body">
							<span id="warning"></span>
                            <?php
							$attform = array(
									'id' => 'form-balas-cepat',
									'role' => 'form'
								);
							echo form_open('admin/pesan/act_pesan', $attform);
							?>
								<input type="hidden" name="pesan_untuk" value="<?= $datapesan->pesan_dari;?>">
								<input type="hidden" name="pesan_judul" value="RE:<?= $datapesan->pesan_judul;?>">
								<div class="col-lg-12">
									<div class="form-group">
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
								</div><!-- /.col-lg-12 -->
                            </form>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
           </div><?php } ?>
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
    
    <?php
    echo "<script src='".base_url('assets/plugins/validasi/jquery.form-validator.js')."'></script>";
    if($datapesan->pesan_dari != $this->session->userdata('user_id')){
		echo $kirim;
		echo $validasi;
	}
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
