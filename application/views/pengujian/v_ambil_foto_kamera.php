<?php
	$dt = date("ymdhis");
	$ip = 1+$cam;
	$url = 'http://192.168.1.20'.$ip.'/Streaming/Channels/1/picture?videoResolutionWidth=1280&videoResolutionHeight=720';

	$username='admin';
	$password='hik12345';

	$ch = curl_init();

	if (!is_dir('files/foto/'.$kode)) {
		mkdir('./files/foto/' . $kode, 0777, TRUE);
	}

	$my_save_dir = 'files/foto/'.$kode.'/';
	$filename = $kode.'_CAM'.$cam;
	$complete_save_loc = $my_save_dir . $filename.".jpeg";

	$fp = fopen($complete_save_loc, 'wb');
	curl_setopt($ch, CURLOPT_URL, ${'url'});
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_ALL);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$img = base_url().$complete_save_loc;
?>

<img class="img-responsive" src="<?php echo $img;?>">

<div class="col-xs-12 text-center">
	<a href="<?php echo site_url('uji/hapusfotokamera?cam='.$cam.'&id='.$kode.'&redirect='.$redirect); ?>" class="btn btn-xs btn-danger" data-rel="tooltip" onclick="return confirm('Anda yakin akan menghapus foto?')" title="Hapus foto">
		Hapus Foto<i class="ace-icon fa fa-trash"></i>
	</a>
</div>

