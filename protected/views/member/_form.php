<div class="form col-sm-6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('multiple'=>'multiple',
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'nama'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'nama',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'nama'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'alamat'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'alamat',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'alamat'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'hp'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'hp',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'hp'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'tgllahir'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'tgllahir',array('class'=>'form-control datepicker','data-format'=>"yyyy-mm-dd")); ?>
			<?php echo $form->error($model,'tgllahir'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'bank'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'bank',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'bank'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
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
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'ektp'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'ektp',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'ektp'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'rekening'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'rekening',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'rekening'); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-sm-5">
			<?php echo $form->labelEx($model,'foto'); ?>
		</div>
        <div class="col-sm-6">
<input name="Profile[foto]" accept="image/*" type="file" class="form-control file2 inline btn btn-primary" multiple="multiple" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
	</div>
	</div>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-blue')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<!-- Imported styles on this page -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/selectboxit/jquery.selectBoxIt.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/minimal/_all.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/square/_all.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/flat/_all.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/futurico/futurico.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/polaris/polaris.css">

    <!-- Bottom scripts (common) -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>

    <!-- Imported scripts on this page -->

    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/select2/select2.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/typeahead.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/moment.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.multi-select.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/icheck.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/neon-chat.js"></script>