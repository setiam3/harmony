<?php
$this->breadcrumbs=array(
	'Wds'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	array('label'=>'List Wd', 'url'=>array('index')),
	array('label'=>'Manage Wd', 'url'=>array('admin')),
);*/
?>

<h1>Create Wd</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>