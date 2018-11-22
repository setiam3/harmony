<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'username',array('class'=>'col-sm-2')); ?>
		<div class="col-sm-5">
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
		</div>
	</div>
	</div>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'col-sm-2')); ?>
		<div class="col-sm-5">
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
	</div>
	</div>
	</div>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-2')); ?>
		<div class="col-sm-5">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		</div>
		</div>
	</div>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'superuser',array('class'=>'col-sm-2')); ?>
		<div class="col-sm-5">
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
	</div>
	</div>
	</div>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2')); ?>
		<div class="col-sm-5">
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
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
		<?php echo $form->labelEx($profile,$field->varname,array('class'=>'col-md-2')); ?>
            <div class="col-md-3">
		<?php 

		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>3, 'cols'=>50,'class'=>'form-control'));
                } elseif($field->field_type=="DATE"){
                    echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control datepicker','data-format'=>"yyyy-mm-dd",'value'=> date('Y-m-d')));
                }else{
                    if($field->varname=='kode_upline' || $field->varname=='sponsor'){
echo $form->dropDownList($profile,$field->varname,array());
                    }else{
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control'));
                }}
		 ?>
		<?php //echo $form->error($profile,$field->varname); ?>
	</div></div></div>	

			<?php
			}
		}
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
var memberid='';
$.ajax({
            type: "post",
            data:{id:memberid},
            url: '<?php echo $this->createUrl('jsonmember')?>',
            success: function(data)
            {
            	console.log(JSON.parse(data));
    	$.each(JSON.parse(data), function(index, obj){
            		//console.log(index);
			$('#Profile_kode_upline').append($('<option>', {value: obj.id,text: obj.text}));
			
		});

            }
        });
	</script>

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