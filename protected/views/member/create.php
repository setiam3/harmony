<?php
$this->breadcrumbs=array(
	'Member'=>array('/member'),
	'Create',
);?>
<h1>Join Member</h1>

<?php
	echo $this->renderPartial('_register', array('model'=>$model,'profile'=>$profile));
?>