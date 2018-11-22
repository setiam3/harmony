<?php
$this->breadcrumbs=array(
	'Member'=>array('/member'),
	'Create',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
	echo $this->renderPartial('_register', array('model'=>$model,'profile'=>$profile));
?>