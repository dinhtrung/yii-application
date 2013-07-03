<?php

class ThongkeController extends WebBaseController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new SanPhamDonHang('search');
		$this->render('indexSanPhamDonHang',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('viewSanPhamDonHang',array(
			'model'=>$this->loadModel('SanPhamDonHang'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SanPhamDonHang('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SanPhamDonHang']))
			$model->attributes=$_GET['SanPhamDonHang'];

		$this->render('adminSanPhamDonHang',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SanPhamDonHang;

		$this->performAjaxValidation($model, 'san-pham-don-hang-form');

		if(isset($_POST['SanPhamDonHang']))
		{
			$model->attributes=$_POST['SanPhamDonHang'];
			if ($model->validate()){
				// More customization goes here
				
				if($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully create new SanPhamDonHang :title', array(':title' => $model->spid))); 
				
					$this->redirect(array('view',$model->primaryKey));
		
				}			
			}
		}

		$this->render('createSanPhamDonHang',array(
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
		$model=$this->loadModel('SanPhamDonHang');

		$this->performAjaxValidation($model, 'san-pham-don-hang-form');

		if(isset($_POST['SanPhamDonHang']))
		{
			$model->attributes=$_POST['SanPhamDonHang'];
			if($model->validate()){
				// More customization goes here
				if ($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully update SanPhamDonHang :title', array(':title' => $model->spid)));
				
					$this->redirect(array('view',$model->primaryKey));
					
				}
			}
		}

		$this->render('updateSanPhamDonHang',array(
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
			$this->loadModel('SanPhamDonHang')->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}