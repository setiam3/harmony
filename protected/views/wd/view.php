<?php
$this->breadcrumbs=array(
	'Wds'=>array('index'),
	$model->id,
);

?>

<h1>View Wd #<?php echo $model->id; ?></h1>

<?php $attributes=array(
				'id',
		'jumlahwd',
		'kode_member',
		'tanggal_wd',
		'jumlahbayar',
		'tanggalbayar',
		'keterangan',
	);
$this->genListView($model,$attributes,$model->id);
?>