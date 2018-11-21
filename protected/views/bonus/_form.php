<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bonus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
			<?php echo $form->labelEx($model,'tanggal'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'tanggal',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'tanggal'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'bonus'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'bonus',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'bonus'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'poin'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'poin',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'poin'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'bonus_diambil'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'bonus_diambil',array('class'=>'form-control','size'=>1,'maxlength'=>1)); ?>
			<?php echo $form->error($model,'bonus_diambil'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'tanggal_ambil'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'tanggal_ambil',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'tanggal_ambil'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'keterangan'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'keterangan',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'keterangan'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'dari_member'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'dari_member',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'dari_member'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'idbonus'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'idbonus',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'idbonus'); ?>
		</div>
	</div>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->