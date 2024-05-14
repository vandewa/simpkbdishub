<div class="row">

<?php
for($i = 0; $i < 4; $i++){
	$dt = date("ymdhis");

	$url0 = 'http://192.168.1.202/Streaming/Channels/1/picture?videoResolutionWidth=1280';
	$url1 = 'http://192.168.1.203/Streaming/Channels/1/picture?videoResolutionWidth=1280';
	$url2 = 'http://192.168.1.204/Streaming/Channels/1/picture?videoResolutionWidth=1280';
	$url3 = 'http://192.168.1.205/Streaming/Channels/1/picture?videoResolutionWidth=1280';

	$username='admin';
	$password='hik12345';

	$ch = curl_init();

	if (!is_dir('files/foto/'.$kode)) {
		mkdir('./files/foto/' . $kode, 0777, TRUE);
	}

	$my_save_dir = 'files/foto/'.$kode.'/';
	$filename = $kode.'_CAM'.$i;
	$complete_save_loc = $my_save_dir . $filename.".jpeg";

	$fp = fopen($complete_save_loc, 'wb');
	curl_setopt($ch, CURLOPT_URL, ${'url' . $i});
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

	<div class="col-xs-12 col-sm-3">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="smaller center">
					KAMERA <?php echo $i;?>
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main center">
					<img class="img-responsive" src="<?php echo $img;?>">
				</div>
			</div>
		</div>
	</div>
<?php } ?>

	<div class="col-xs-12 text-center">
		<a href="<?php echo site_url('uji/hapusfoto?id='.$kode.'&redirect='.$redirect); ?>" class="btn btn-danger btn-bold" data-rel="tooltip" onclick="return confirm('Anda yakin akan menghapus foto?')" title="Hapus foto">
			Hapus Foto <i class="ace-icon fa fa-trash bigger-120"></i>
		</a>
	</div>
</div>

