<?php

class AdminController extends WebBaseController
{
	public $defaultAction = 'admin';
	
	/**
	 * Manage all User
	 */
	public function actionAdmin(){
		$model = new User('search');
		$this->render('adminUser', array('model' => $model));
	}
	
	/**
	 * Display details for an user
	 */
	public function actionView(){
		$model = $this->loadModel('User');
		$this->render('viewUser', array('model' => $model));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$this->performAjaxValidation($model, 'user-form');
		Rights::getAuthorizer()->attachUserBehavior($model);
		/*
		// Get assigned Items for current user
		$assignedItems = Rights::getAuthorizer()->getAuthItems(CAuthItem::TYPE_ROLE, $model->getId());
		$model->role = array_keys($assignedItems);
		*/
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$model->createtime=time();
			$model->updatetime=time();
			if($model->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					// Update and redirect
					foreach ($model->role as $role)
						Rights::getAuthorizer()->authManager->assign($role, $model->getId());
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}

		$this->render('createUser',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel('User');
		$this->performAjaxValidation($model, 'user-form');
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];

			if($model->validate()) {
				$old_password = User::model()->findByPk($model->id);
				$old_role = Rights::getAuthorizer()->getAuthItems(NULL, $model->id);
				if (! empty($model->password) AND ($old_password->password!=$model->password)) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				} else { $model->password = $old_password->password; }
				if ($model->save()){
					// Find the difference between new and old roles and delete unassigned one..
					foreach ($old_role as $name => $item){
						if (! in_array($name, $model->role)) $item->revoke($model->id);
					}
					$oldAuthNames = array_keys($old_role);
					foreach ($model->role as $role){
						if (in_array($role, $oldAuthNames)) continue;
						Rights::getAuthorizer()->authManager->assign($role, $model->getId());
					}
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}

		$this->render('updateUser',array(
			'model'=>$model,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel('User');
			Rights::getAuthorizer()->attachUserBehavior($model);
			Rights::getAuthorizer()->authManager->revoke($model->role, $model->getId());
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}