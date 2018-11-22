<?php
$this->breadcrumbs=array(
	'Member'=>array('index'),
	$model->user_id=>array('view','user_id'=>$model->user_id),
	'Update',
);

?>

<h1>Update Profile <?php //echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); 
if(!empty($model->foto)){
	echo CHtml::image(Controller::imagesUrl().$model->foto,'profile',array('class'=>'col-sm-6'));
}
?>