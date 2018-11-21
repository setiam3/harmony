<?php

class MemberController extends Controller
{
	public $columns=array(
				array(
        		'type'=>'html',
        		'name'=>'kode_member',
        		'value'=>'CHtml::link($data->kode_member,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'email',
        		'value'=>'CHtml::link($data->email,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'nik',
        		'value'=>'CHtml::link($data->nik,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'level',
        		'value'=>'CHtml::link($data->level,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'kode_upline',
        		'value'=>'CHtml::link($data->kode_upline,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			);

	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionIndex()
	{
		$model=new Member('search');
	$model->unsetAttributes();

		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
		 'id'            => 'mm-grid',
		 'dataProvider'  => $model->search($this->columns),
		 'ajaxUrl'       => $this->createUrl($this->getAction()->getId()),
		 'columns'       => $this->columns,
         'bootstrap'=>true,
		));
		
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
		  $this->render('index', array('widget' => $widget));
		  return;
		} else {
		  echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
		  Yii::app()->end();
		}
	}

	public function actionUpdate()
	{
		$this->render('update');
	}
}