<?php

class OrderdetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Orderdetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orderdetail']))
		{
			$model->attributes=$_POST['Orderdetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orderdetail']))
		{
			$model->attributes=$_POST['Orderdetail'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public $columns=array(
				array(
        		'type'=>'html',
        		'name'=>'order_code',
        		'value'=>'CHtml::link($data->order_code,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'order_id',
        		'value'=>'CHtml::link($data->order_id,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'product_id',
        		'value'=>'CHtml::link($data->product_id,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'qty',
        		'value'=>'CHtml::link($data->qty,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'subtotal',
        		'value'=>'CHtml::link($data->subtotal,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
	);

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Orderdetail('search');
		$model->unsetAttributes();

		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
		 'id'            => 'Orderdetail-grid',
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

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$ar1=array('class'=> 'EButtonColumn',
            'template'=>'{update}{delete}',
		    'buttons'=>array(
		    	'update'=>array(
		    		'url'=>'Yii::app()->createUrl("Orderdetail/update/$data->id")',
		    		),
		        'delete' => array(
		        	'url'=>'Yii::app()->createUrl("Orderdetail/delete/$data->id")',
		            'visible'=>'Yii::app()->user->getIsSuperuser()==1',           
		        ),
		    ));
        array_push($this->columns,$ar1);

		$model=new Orderdetail('search');
		$model->unsetAttributes();

		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
		 'id'            => 'bonus-grid',
		 'dataProvider'  => $model->search($this->columns),
		 'ajaxUrl'       => $this->createUrl($this->getAction()->getId()),
		 'columns'       => $this->columns,
         'bootstrap'=>true,
		));
		
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
		  $this->render('admin', array('widget' => $widget));
		  return;
		} else {
		  echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
		  Yii::app()->end();
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Orderdetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orderdetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
