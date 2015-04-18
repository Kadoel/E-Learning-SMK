<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Elearning</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/plugins/metisMenu/metisMenu.min.'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Login</h3>
                    </div>
                    <div class="panel-body">
						<div class="confirm"></div>
						<?php
						$attform = array(
								'id' => 'form-login',
								'role' => 'form'
						);
						echo form_open('login/act_login', $attform);
						?>
                            <fieldset>
                                <div class="form-group">
									<?php
									$attusername = array(
												'class' => 'form-control',
												'placeholder' => 'Username',
												'name' => 'username',
												'id' => 'username',
												'data-validation'=>'required',
												'data-validation-error-msg'=>'Silahkan isi Username'
									);
									echo form_input($attusername);
									echo form_error('username');
									?>
                                </div>
                                <div class="form-group">
									<?php
									$attpass = array(
												'class' => 'form-control',
												'placeholder' => 'Password',
												'name' => 'password',
												'id' => 'password',
												'data-validation'=>'required',
												'data-validation-error-msg'=>'Silahkan isi Password'
									);
									echo form_password($attpass);
									echo form_error('password');
									?>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <?php 
                                $attsubmit = array(
										'class'=>'btn btn-lg btn-success btn-block',
										'id'=>'smb-login',
										'name'=>'smb-login',
										'type'=>'submit',
										'content'=>'Login'); 
								echo form_button($attsubmit); ?>
                            </fieldset>
                        </form>
                    </div><!-- ./panel-body -->
                </div><!-- ./login-panel panel panel-default -->
            </div><!-- ./col-md-4 col-md-offset-4 -->
        </div><!-- ./row -->
    </div><!-- ./container -->

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
    
    <?= $validasi; ?>
    
    <script>
	// assumes you're using jQuery
		$(document).ready(function() {
			$('.confirm').hide();
			<?php if($this->session->flashdata('notification')){ ?>
				$('.confirm').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('notification'); ?></div>').show();
			});
		<?php } ?>
	</script>

</body>

</html>
