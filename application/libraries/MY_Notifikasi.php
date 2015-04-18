<?php
class MY_Notifikasi{
	function sukses($judul, $pesan, $arah){
		$sukses = "<script type='text/javascript'> alertify.alert('".$judul."', '".$pesan."').setting('onok', function(){ window.location='".site_url(''.$arah.'')."';} ); </script>";
		
		echo $sukses;
	}
	
	function suksesreload($judul, $pesan){
		$suksesreload = "<script type='text/javascript'> alertify.alert('".$judul."', '".$pesan."').setting('onok', function(){ location.reload();} ); </script>";
		echo $suksesreload;
	}
	
	function kesalahan($pesan){
		$kesalahan = '<div class="alert alert-warning alert-dismissable"><i class="fa fa-warning"></i> '.$pesan.' </div>';
		return $kesalahan;
	}
}
?>
