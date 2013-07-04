<?php

class ProductsController extends WebBaseController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$model = $this->loadModel('SanPham');
		$this->render('viewSanPham',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new SanPham('search');
		$this->render('indexSanPham',array(
			'model'=>$model,
		));
	}
}