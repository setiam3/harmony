<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
        public function actionCari($act, $q){
            Controller::cari($act, $q);
        }

        /**
	 * Registration user
	 */
    public function actionJsonmember(){
    	$js=array();
    	if(empty($_POST['id'])){
    		if(empty(Member::model()->findAll())){
	    		$js[]=array('id'=>'#','text'=>'#');
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
	public function actionRegistration() {
		$this->layout='//layouts/register';
            $model = new RegistrationForm;
            $profile=new Profile;
            $profile->regMode = true;

			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model,$profile));
				Yii::app()->end();
			}
			
		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					$profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
					if($model->validate()&&$profile->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->superuser=0;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						if ($model->save()) {
							$profile->user_id=$model->id;
                            $profile->kode_member= Controller::autoformat();//generate kodemember
                            $profile->sponsor=$profile->kode_upline;//jika ada upline otomatis sponsor
							$profile->save();
							

							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
								UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}
							
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
								}

	//insert into authasignment;
	$q="insert into AuthAssignment (itemname, userid) values ('user','$profile->user_id')";
	Yii::app()->db->createCommand($q)->execute();
	//end insert
	Controller::hitungbonusgetmember($profile->kode_upline,$profile->kode_member);
	Controller::upgradelevel($profile->kode_upline);
	Controller::bonussponsor($profile->sponsor,$profile->kode_member);//end update

								$this->refresh();

							}
						}
					} else $profile->validate();
				}
			    $this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
		    }
	}
}