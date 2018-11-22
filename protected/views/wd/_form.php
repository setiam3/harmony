<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wd-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'jumlahwd'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'jumlahwd',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'jumlahwd'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'kode_member'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'kode_member',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'kode_member'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'tanggal_wd'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'tanggal_wd',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'tanggal_wd'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'jumlahbayar'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'jumlahbayar',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'jumlahbayar'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'tanggalbayar'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'tanggalbayar',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'tanggalbayar'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'keterangan'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'keterangan',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'keterangan'); ?>
		</div>
	</div>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->