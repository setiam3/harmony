<?php
$this->breadcrumbs=array(
	'Bonuses'=>array('index'),
	$model->id,
);

?>

<h1>View Bonus #<?php echo $model->id; ?></h1>

<?php $attributes=array(
				'id',
		'kode_member',
		'tanggal',
		'bonus',
		'poin',
		'bonus_diambil',
		'tanggal_ambil',
		'keterangan',
		'dari_member',
		'idbonus',
	);
$this->genListView($model,$attributes,$model->id);
?>