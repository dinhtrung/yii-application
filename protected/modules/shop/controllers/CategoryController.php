<?php

class CategoryController extends WebBaseController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('viewLoaiSanPham',array(
			'model'=>$this->loadModel('LoaiSanPham'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new LoaiSanPham('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LoaiSanPham']))
			$model->attributes=$_GET['LoaiSanPham'];

		$this->render('adminLoaiSanPham',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new LoaiSanPham;

		$this->performAjaxValidation($model, 'loai-san-pham-form');

		if(isset($_POST['LoaiSanPham']))
		{
			$model->attributes=$_POST['LoaiSanPham'];
			if ($model->validate()){
				if (! empty($model->root) && ($root = LoaiSanPham::model()->findByPk($model->root))){
					$model->appendTo($root);
				} 
				if($model->saveNode()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully create new LoaiSanPham :title', array(':title' => $model->id))); 
					
					$this->redirect(array('view','id'=>$model->primaryKey));
		
				}			
			}
		}

		$this->render('createLoaiSanPham',array(
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
		$model=$this->loadModel('LoaiSanPham');

		$this->performAjaxValidation($model, 'loai-san-pham-form');

		if(isset($_POST['LoaiSanPham']))
		{
			$model->attributes=$_POST['LoaiSanPham'];
			if($model->validate()){
				if (! empty($model->root) && ($root = LoaiSanPham::model()->findByPk($model->root))){
					$model->moveAsLast($root);
				} else {
					$model->moveAsRoot();
				}
				if ($model->saveNode()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully update LoaiSanPham :title', array(':title' => $model->id)));
					$this->redirect(array('view','id'=>$model->primaryKey));
					
				}
			}
		}

		$this->render('updateLoaiSanPham',array(
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
			$this->loadModel('LoaiSanPham')->deleteNode();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}