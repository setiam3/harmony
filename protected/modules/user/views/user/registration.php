<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile)); ?>
        <div class="row">
	<div class="form-group">
	<?php echo $form->labelEx($model,'username',array('class'=>'col-md-4')); ?>
	<div class="col-md-5 ">
	<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
	</div>
	</div>
	</div>
        <div class="row">
	<div class="form-group">
	<?php echo $form->labelEx($model,'email',array('class'=>'col-md-4')); ?>
	<div class="col-md-5 ">
	<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="form-group">
	<?php echo $form->labelEx($model,'password',array('class'=>'col-md-4')); ?>
	<div class="col-md-5 ">
	<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="form-group">
	<?php echo $form->labelEx($model,'verifyPassword',array('class'=>'col-md-4')); ?>
	<div class="col-md-5 ">
	<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'form-control')); ?>
	</div>
	</div>
	</div>
	
	
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($profile,$field->varname,array('class'=>'col-md-4')); ?>
            <div class="col-md-5 ">
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
                } elseif($field->field_type=="DATE"){
                    echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control datepicker','data-format'=>"yyyy-mm-dd",'value'=> date('Y-m-d')));
                }else{
                    if($field->varname=='kode_upline' || $field->varname=='sponsor'){
                        echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control typeahead','data-remote'=>$this->createUrl('cari?act=upline&q=%QUERY')));
                    }else{
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control'));
                }}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div></div></div>	
			<?php
			}
		}
?>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
            <div class="form-group">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	</div>	</div>

	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>

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