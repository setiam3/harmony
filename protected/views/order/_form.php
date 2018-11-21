<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'order_code'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'order_code',array('class'=>'form-control','size'=>17,'maxlength'=>17)); ?>
			<?php echo $form->error($model,'order_code'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'order_date'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'order_date',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'order_date'); ?>
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
			<?php echo $form->labelEx($model,'bank_transfer'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'bank_transfer',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'bank_transfer'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'payment_status'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'payment_status',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'payment_status'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'grandtotal'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'grandtotal',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'grandtotal'); ?>
		</div>
	</div>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->