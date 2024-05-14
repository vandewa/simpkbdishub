<?php foreach($dt_berkas as $row){ ?>
<center>
	<embed type="application/pdf" src="<?php echo base_url('files/berkas/'.$row->no_uji.'/'.$row->raw_berkas);?>" width="100%" height="100%"></embed>
</center>
<?php } ?>