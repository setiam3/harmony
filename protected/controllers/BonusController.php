<?php

class BonusController extends Controller
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
		$model=new Bonus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bonus']))
		{
			$model->attributes=$_POST['Bonus'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionPembayaran(){

	}
	public function actionCairkan(){
		//user cairkan dana bonus;
		$dana=Bonus::model()->findAll(array('condition'=>'kode_member="'.Controller::id_member().'" and bonus > 0 and bonus_diambil="N"'));
		if(!empty($dana)){
			//echo $dana->bonus_diambil;
			$totalcairkan=0;
			$criteria=new CDbCriteria;
			$criteria->condition='bonus > 0 and bonus_diambil="N" and kode_member="'.Controller::id_member().'"';
			foreach ($dana as $value) {
					Bonus::model()->updateAll(array(
					'bonus_diambil'=>'Y',
					'tanggal_ambil'=>Controller::date_sql_now()
					),$criteria);
				$totalcairkan+=$value->bonus;
			}
			if($totalcairkan>=250000){
				//insert to wd
				$wd=new Wd;
				$wd->kode_member=Controller::id_member();
				$wd->jumlahwd=$totalcairkan;
				$wd->jumlahbayar=$totalcairkan;
				$wd->keterangan='Transfer ke '.Member::model()->findByAttributes(array('kode_member'=>Controller::id_member()))->bank.'-'.Member::model()->findByAttributes(array('kode_member'=>Controller::id_member()))->rekening;
				$wd->tanggal_wd=Controller::date_sql_now();
				if($wd->save()){
					//echo 'silahkan share webreplika anda. silahkan tunggu proses pencairan di hari selasa dan kamis tiap minggunya';

					$share="https://www.facebook.com/sharer/sharer.php?u=www.bestharmony.co.id";
					$this->redirect($share);
				}
			}else{
				echo 'saldo minimal 250000 untuk dicairkan';
			}
		}
		echo 'bonus anda kosong';
		//$share="https://www.facebook.com/sharer/sharer.php?u=www.bestharmony.co.id"; $this->redirect($share);
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

		if(isset($_POST['Bonus']))
		{
			$model->attributes=$_POST['Bonus'];
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
        		'name'=>'kode_member',
        		'value'=>'CHtml::link($data->kode_member,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'tanggal',
        		'value'=>'CHtml::link($data->tanggal,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'bonus',
        		'value'=>'CHtml::link($data->bonus,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'poin',
        		'value'=>'CHtml::link($data->poin,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'bonus_diambil',
        		'value'=>'CHtml::link($data->bonus_diambil,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'tanggal_ambil',
        		'value'=>'CHtml::link($data->tanggal_ambil,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'keterangan',
        		'value'=>'CHtml::link($data->keterangan,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'dari_member',
        		'value'=>'CHtml::link($data->dari_member,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'idbonus',
        		'value'=>'CHtml::link($data->idbonus,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
	);

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//echo 'Transfer ke '.Member::model()->findByAttributes(array('kode_member'=>Controller::id_member()))->bank.'-'.Member::model()->findByAttributes(array('kode_member'=>Controller::id_member()))->rekening;
		$model=new Bonus('search');
		$model->unsetAttributes();

		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
		 'id'            => 'Bonus-grid',
		 'dataProvider'  => $model->search($this->columns),
		 'ajaxUrl'       => $this->createUrl($this->getAction()->getId()),
		 'columns'       => $this->columns,
         'bootstrap'=>true,
		));
		$total=$model->totalbonus();
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
		  $this->render('index', array('widget' => $widget,'total'=>$total));
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
		    		'url'=>'Yii::app()->createUrl("Bonus/update/$data->id")',
		    		),
		        'delete' => array(
		        	'url'=>'Yii::app()->createUrl("Bonus/delete/$data->id")',
		            'visible'=>'Yii::app()->user->getIsSuperuser()==1',           
		        ),
		    ));
        array_push($this->columns,$ar1);

		$model=new Bonus('search');
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
		$model=Bonus::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='bonus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
