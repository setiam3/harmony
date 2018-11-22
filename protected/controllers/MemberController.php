<?php

class MemberController extends Controller
{
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	public function actionJsonmember(){
    	$js=array();
    	if(empty($_POST['id'])){
    		if(empty(Member::model()->findAll())){
	    		$js=array('id'=>'#','text'=>'#');
	    	}else{
	    		foreach(Member::model()->findAll('level!="distributor"') as $k=>$row){
		    		$js[]=array('id'=>$row->kode_member,'text'=>$row->kode_member.'-'.$row->nama.'-'.$row->alamat);
		    	}
	    	}
    	}else{
    		foreach(Member::model()->findAll('level!="distributor" and kode_member="'.$_POST['id'].'"') as $k=>$row){
		    		$js[]=array('id'=>$row->kode_member,'text'=>$row->kode_member.'-'.$row->nama.'-'.$row->alamat);
		    	}
    	}
    	echo CJSON::encode($js);
    }
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
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
        		'name'=>'ektp',
        		'value'=>'CHtml::link($data->ektp,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
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

	public function actionView($id)
	{
		if(Yii::app()->user->id==$id){
			$model=Member::model()->findByAttributes(array('id'=>$id));
			$this->render('view',array('model'=>$model));
		}
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

	public function actionUpdate($id)
	{
		if(Yii::app()->user->id==$id){
		$model=$this->loadModel($id);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			$images=CUploadedFile::getInstancesByName('Profile[foto]');
			foreach ($images as $image=>$pic) {
                $ext=substr($pic, strrpos($pic, '.')+1);
                if(in_array($ext, $this->arrayImages)){
                    $pic->saveAs($this->imagesPath().'Member'.$model->kode_member.'.'.$ext);
                }else{
                    $messageType = 'warning';
                    $message = "<strong>Only images file type allowed";
                    Yii::app()->user->setFlash($messageType, $message);
                    $this->redirect(array('create'));
                }
                $foto='Member'.$model->kode_member.'.'.$ext;
            //image resize
$image= Yii::app()->image->load($this->imagesPath().'Member'.$model->kode_member.'.'.$ext);
                    $image->resize(640,640);
                    $image->save();
                    
                    }
                $model->foto=$foto;
//print_r($model->foto);die;
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));}echo 'access denied';
	}
	public function loadModel($id)
	{
		$model=Profile::model()->findByAttributes(array('user_id'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}