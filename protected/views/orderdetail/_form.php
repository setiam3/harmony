<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orderdetail-form',
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
				<?php echo $form->textField($model,'order_code',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'order_code'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'order_id'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'order_id',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'order_id'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'product_id'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'product_id',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'product_id'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'qty'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'qty',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'qty'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'subtotal'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'subtotal',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'subtotal'); ?>
		</div>
	</div>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->