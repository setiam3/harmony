<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('multiple'=>'multiple',
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'nama_produk'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'nama_produk',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'nama_produk'); ?>
		</div>
	</div>
</div>


<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'harga'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textField($model,'harga',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'harga'); ?>
		</div>
	</div>
</div>


<div class="row">
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo $form->labelEx($model,'desc'); ?>
		</div>
        <div class="col-sm-6">
				<?php echo $form->textArea($model,'desc',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'desc'); ?>
		</div>
	</div>
</div>


<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'image',array('class'=>'col-sm-2')); ?>
            <div class="col-sm-6">
<input name="foto" accept="image/*" type="file" class="form-control file2 inline btn btn-primary" multiple="multiple" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
	</div>
	</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
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