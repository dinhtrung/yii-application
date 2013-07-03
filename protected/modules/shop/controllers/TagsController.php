<?php

class TagsController extends WebBaseController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new ThePhanLoai('search');
		$this->render('indexThePhanLoai',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('viewThePhanLoai',array(
			'model'=>$this->loadModel('ThePhanLoai'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ThePhanLoai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ThePhanLoai']))
			$model->attributes=$_GET['ThePhanLoai'];

		$this->render('adminThePhanLoai',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ThePhanLoai;

		$this->performAjaxValidation($model, 'the-phan-loai-form');

		if(isset($_POST['ThePhanLoai']))
		{
			$model->attributes=$_POST['ThePhanLoai'];
			if ($model->validate()){
				// More customization goes here
				
				if($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully create new ThePhanLoai :title', array(':title' => $model->id))); 
					
					$this->redirect(array('view','id'=>$model->primaryKey));
		
				}			
			}
		}

		$this->render('createThePhanLoai',array(
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
		$model=$this->loadModel('ThePhanLoai');

		$this->performAjaxValidation($model, 'the-phan-loai-form');

		if(isset($_POST['ThePhanLoai']))
		{
			$model->attributes=$_POST['ThePhanLoai'];
			if($model->validate()){
				// More customization goes here
				if ($model->save()){
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully update ThePhanLoai :title', array(':title' => $model->id)));
					
					$this->redirect(array('view','id'=>$model->primaryKey));
					
				}
			}
		}

		$this->render('updateThePhanLoai',array(
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
			$this->loadModel('ThePhanLoai')->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}