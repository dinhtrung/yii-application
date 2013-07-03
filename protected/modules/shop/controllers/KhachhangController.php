<?php

class KhachhangController extends WebBaseController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new KhachHang('search');
		$this->render('indexKhachHang',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('viewKhachHang',array(
			'model'=>$this->loadModel('KhachHang'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KhachHang('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KhachHang']))
			$model->attributes=$_GET['KhachHang'];

		$this->render('adminKhachHang',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KhachHang;

		$this->performAjaxValidation($model, 'khach-hang-form');

		if(isset($_POST['KhachHang']))
		{
			$model->attributes=$_POST['KhachHang'];
			if ($model->validate()){
				// More customization goes here
				
				if($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully create new KhachHang :title', array(':title' => $model->uid))); 
					
					$this->redirect(array('view','id'=>$model->primaryKey));
		
				}			
			}
		}

		$this->render('createKhachHang',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel('KhachHang');

		$this->performAjaxValidation($model, 'khach-hang-form');

		if(isset($_POST['KhachHang']))
		{
			$model->attributes=$_POST['KhachHang'];
			if($model->validate()){
				// More customization goes here
				if ($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully update KhachHang :title', array(':title' => $model->uid)));
					
					$this->redirect(array('view','id'=>$model->primaryKey));
					
				}
			}
		}

		$this->render('updateKhachHang',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		if (Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel('KhachHang')->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}