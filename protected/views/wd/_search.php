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
		<?php echo $form->label($model,'jumlahwd'); ?>
		<?php echo $form->textField($model,'jumlahwd',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_member'); ?>
		<?php echo $form->textField($model,'kode_member',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_wd'); ?>
		<?php echo $form->textField($model,'tanggal_wd',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlahbayar'); ?>
		<?php echo $form->textField($model,'jumlahbayar',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggalbayar'); ?>
		<?php echo $form->textField($model,'tanggalbayar',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->