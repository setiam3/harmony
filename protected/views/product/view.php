<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);

?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $attributes=array(
				'id',
		'nama_produk',
		'harga',
		'desc',
		'image',
	);
$this->genListView($model,$attributes,$model->id);
echo CHtml::image(Controller::imagesUrl().$model->image);
?>