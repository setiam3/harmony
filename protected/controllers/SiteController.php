<?php

class SiteController extends Controller
{

	public function actionTree() {
        $data = $this->getDataFormatted($this->getData());
        $this->render('index', array('data'=>$data));
	}
    public function actionTreeFill() {
        if ( ! isset($_GET['root']))
            $personId = 'source';
        else
            $personId = $_GET['root'];
        $persons = ($personId == 'source') ?
			$this->getData() : $this->recursiveSearch($personId, $this->getData());
		$dataTree = array();
        if (is_array($persons)) {
            foreach($persons as $parent)
                $dataTree[] = $this->formatData($parent);
        }
        echo json_encode($dataTree);
//        echo CTreeView::saveDataAsJson($dataTree);
    }
	protected function recursiveSearch($id, $rootnode) {
       if (is_array($rootnode)) {
            foreach($rootnode as $person) {
                if ($person['id'] == $id)
                    return $person["parents"];
                else {
                    $r = $this->recursiveSearch($id, $person["parents"]);
                    if ($r !== null)
                         return $r;
				}
			}
		}
		return null;
    }
    protected function formatData($person) {
      return array(
		  'text'=>$person['name'],
		  'id'=>$person['id'],
		  'hasChildren'=>isset($person['parents']));
    }
    protected function getDataFormatted($data) {
        foreach($data as $k=>$person) {
            $personFormatted[$k] = $this->formatData($person);
            $parents = null;
            if (isset($person['parents'])) {
                $parents = $this->getDataFormatted($person['parents']);
                $personFormatted[$k]['children'] = $parents;
            }
        }
        return $personFormatted;
    }
	protected function getData() {
		$data = array(
			array("id"=>1, "name"=>"John",
				"parents"=>array(
					array("id"=>10, "name"=>"Mary",
						"parents"=>array(
							array("id"=>100, "name"=>"Jane",
								"parents"=>array(
									array("id"=>1000, "name"=>"Helene"),
									array("id"=>1001, "name"=>"Peter")
								)
							),
							array("id"=>101, "name"=>"Richard",
								"parents"=>array(
									array("id"=>1010, "name"=>"Lisa"),
									array("id"=>1011, "name"=>"William")
								)
							),
						),
					),
					array("id"=>11, "name"=>"Derek",
						"parents"=>array(
							array("id"=>110, "name"=>"Julia"),
							array("id"=>111, "name"=>"Christian",
								"parents"=>array(
									array("id"=>1110, "name"=>"Deborah"),
									array("id"=>1111, "name"=>"Marc"),
								),
							),
						),
					),
				),
			),
		);
        return $data;
    }

    public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
			
		);
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}