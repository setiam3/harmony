<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);

?>

<h1>View Detail Profile</h1>
<div class="col-sm-7">
<?php $attributes=array(
		'username',
		'email',
		'ektp',
		'nama',
		'alamat',
		'hp',
		'bank',
		'rekening',
		'tgllahir',
		'level',
		'kode_member',
		'kode_upline',
		'sponsor',
	);
$this->genListView($model,$attributes,$model->id);
?></div>
<div class="col-sm-5">
	<?php echo CHtml::image(Controller::imagesUrl().$model->foto,'profile',array('class'=>'col-sm-12'));?>
	
</div>