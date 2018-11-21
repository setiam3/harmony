<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_member'); ?>
		<?php echo $form->textField($model,'kode_member',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal'); ?>
		<?php echo $form->textField($model,'tanggal',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bonus'); ?>
		<?php echo $form->textField($model,'bonus',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poin'); ?>
		<?php echo $form->textField($model,'poin',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bonus_diambil'); ?>
		<?php echo $form->textField($model,'bonus_diambil',array('class'=>'form-control','size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_ambil'); ?>
		<?php echo $form->textField($model,'tanggal_ambil',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dari_member'); ?>
		<?php echo $form->textField($model,'dari_member',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idbonus'); ?>
		<?php echo $form->textField($model,'idbonus',array('class'=>'form-control')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->