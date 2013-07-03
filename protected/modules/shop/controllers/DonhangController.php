<?php

class DonhangController extends WebBaseController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new DonHang('search');
		$this->render('indexDonHang',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('viewDonHang',array(
			'model'=>$this->loadModel('DonHang'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DonHang('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DonHang']))
			$model->attributes=$_GET['DonHang'];

		$this->render('adminDonHang',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DonHang;

		$this->performAjaxValidation($model, 'don-hang-form');

		if(isset($_POST['DonHang']))
		{
			$model->attributes=$_POST['DonHang'];
			if ($model->validate()){
				// More customization goes here
				
				if($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully create new DonHang :title', array(':title' => $model->maDonHang))); 
					
					$this->redirect(array('view','id'=>$model->primaryKey));
		
				}			
			}
		}

		$this->render('createDonHang',array(
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
		$model=$this->loadModel('DonHang');

		$this->performAjaxValidation($model, 'don-hang-form');

		if(isset($_POST['DonHang']))
		{
			$model->attributes=$_POST['DonHang'];
			if($model->validate()){
				// More customization goes here
				if ($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully update DonHang :title', array(':title' => $model->maDonHang)));
					
					$this->redirect(array('view','id'=>$model->primaryKey));
					
				}
			}
		}

		$this->render('updateDonHang',array(
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
			$this->loadModel('DonHang')->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}