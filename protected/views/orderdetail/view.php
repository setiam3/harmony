<?php
$this->breadcrumbs=array(
	'Orderdetails'=>array('index'),
	$model->id,
);

?>

<h1>View Orderdetail #<?php echo $model->id; ?></h1>

<?php $attributes=array(
				'id',
		'order_code',
		'order_id',
		'product_id',
		'qty',
		'subtotal',
	);
$this->genListView($model,$attributes,$model->id);
?>