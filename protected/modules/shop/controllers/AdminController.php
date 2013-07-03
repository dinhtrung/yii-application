<?php

class AdminController extends WebBaseController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('viewSanPham',array(
			'model'=>$this->loadModel('SanPham'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new SanPham('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SanPham']))
			$model->attributes=$_GET['SanPham'];

		$this->render('adminSanPham',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SanPham;

		$this->performAjaxValidation($model, 'san-pham-form');

		if(isset($_POST['SanPham']))
		{
			$model->attributes=$_POST['SanPham'];
			if ($model->validate()){
				// Luu anh thumbnail
				$model->anh = $model->saveFile(
						CUploadedFile::getInstance($model, 'anh'), 
						Yii::getPathOfAlias(SanPham::$thumbDir)
				);
				if($model->save()){
					// multiple upload
					$cnt = 0;
					foreach(CUploadedFile::getInstances($model, 'slide') as $file){
						$slide = $model->saveFile($file, Yii::getPathOfAlias(SanPham::$slideDir));
						if ($slide){
							$slideModel = new SlideSanPham();
							$slideModel->spid = $model->primaryKey;
							$slideModel->tenFile = $slide;
							$slideModel->thuTu = $cnt;
							$slideModel->save();
							$cnt++;
						}
					}
					
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully create new SanPham :title', array(':title' => $model->id))); 
					
					$this->redirect(array('view','id'=>$model->primaryKey));
		
				}			
			}
		}

		$this->render('createSanPham',array(
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
		$model=$this->loadModel('SanPham');

		$this->performAjaxValidation($model, 'san-pham-form');

		if(isset($_POST['SanPham']))
		{
			$old = clone $model;
			$model->attributes=$_POST['SanPham'];
			if($model->validate()){
				// Luu anh thumbnail
				$anh = $model->saveFile(
						CUploadedFile::getInstance($model, 'anh'), 
						Yii::getPathOfAlias(SanPham::$thumbDir)
					);
				// Xoa anh cu neu up anh moi...
				if ($anh){
					$model->anh = $anh;
					@unlink(Yii::getPathOfAlias(SanPham::$thumbDir). DIRECTORY_SEPARATOR . $old->anh);
				} else {
					// Giu nguyen anh cu
					// $model->anh = $old->anh;
				}
				// Ghi du lieu vao DB
				if ($model->save()){
					// Xu ly cac anh slides
					$cnt = SlideSanPham::model()->getDbConnection()
					->createCommand()
					->from(SlideSanPham::model()->tableName())
					->select('MAX(thuTu)')
					->where('spid = :spid')
					->queryScalar(array(':spid' => $model->primaryKey));
					foreach(CUploadedFile::getInstances($model, 'slide') as $file){
						$slide = $model->saveFile($file, Yii::getPathOfAlias(SanPham::$slideDir));
						if ($slide){
							$cnt++;
							$slideModel = new SlideSanPham();
							$slideModel->spid = $model->primaryKey;
							$slideModel->tenFile = $slide;
							$slideModel->thuTu = $cnt;
							$slideModel->save();
						}
					}
					
					Yii::app()->user->setFlash('success', Yii::t('app', 'Successfully update SanPham :title', array(':title' => $model->id)));
					
					$this->redirect(array('view','id'=>$model->primaryKey));
					
				}
			}
		}

		$this->render('updateSanPham',array(
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
			$this->loadModel('SanPham')->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionDeleteslide(){
		if (Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel('SlideSanPham')->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
	}
}