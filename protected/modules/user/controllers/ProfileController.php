<?php

class ProfileController extends WebBaseController
{
	public $defaultAction = 'profile';


	function allowedActions() {
		return 'changepassword, edit, profile';
	}

	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		$model = UserModule::user();
	    $this->render('profile',array(
	    	'model'=>$model,
	    ));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = UserModule::user();
		
		$this->performAjaxValidation($model, 'profile-form');
		
		if(isset($_POST['User']))
		{
			$model->setAttributes($_POST['User']);

			if($model->save()) {
				Yii::app()->user->setFlash('success',Yii::t('user', "Changes is saved."));
			}
		}

		$this->render('editProfile',array(
			'model'=>$model,
		));
	}

	/**
	 * Change password
	 */
	public function actionChangepassword() {
		
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			$this->performAjaxValidation($model, 'changepassword-form');

			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($model->password);
						$new_password->activkey = UserModule::encrypting(microtime().$model->password);
						if ($new_password->save()){
							Yii::app()->user->setFlash('success',Yii::t('user', "New password is saved."));
							$this->redirect(array("profile"));
						}
					}
			}
			$this->render('changePassword',array('model'=>$model));
	    }
	}
}