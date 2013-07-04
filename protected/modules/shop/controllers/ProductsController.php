<?php

class ProductsController extends WebBaseController
{

	public function allowedActions(){
		return '*';
	}
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
	
	/**
	 * Add a product to cart
	 */
	public function actionCart(){
		$model = $this->loadModel('SanPham');
		$cart = Yii::app()->user->getState('cart', array());
		if (array_key_exists($model->primaryKey, $cart))
			$cart[$model->primaryKey] += 1;
		else 
			$cart[$model->primaryKey] = 1;
		Yii::app()->user->setState('cart', $cart);
		Yii::app()->user->setFlash('success', 'Succesfully add item :title to your cart', array(':title' => $model->tenSanPham));
		$this->redirect(array('view', 'id' => $model->primaryKey));
	}
	/**
	 * Checkout process
	 */
	public function actionCheckout(){
		// Danh sach san pham ma khach dat mua: MaSP -> SoLuong
		$cart = Yii::app()->user->getState('cart', array());
		// Lay thong tin san pham
		$ids = array_keys($cart);
		$sanPham = SanPham::model()->findAllByPk($ids);
		// @TODO Tao Nguoi Dung + Gui Mail Thong Bao..
		// @FIXME Tao Don Hang
		$donHang = new DonHang();
		$donHang->uid = Yii::app()->user->id;
		$donHang->maDonHang = Yii::app()->user->getStateKeyPrefix();
		$donHang->trangThai = DonHang::STATUS_PENDING;
		$donHang->save();
		// @FIXME Tao danh sach mat hang
		foreach ($cart as $spid => $soLuong){
			$spdh = new SanPhamDonHang();
			$spdh->spid = $spid;
			$spdh->soLuong = $soLuong;
			$spdh->donGiaSp = $sanPham[$spid]->giaBan;
			$spdh->save();
		}
		// @TODO Gui Email thong bao
		Yii::app()->user->setFlash('success', 'Succesfully contact site admin');
		Yii::app()->user->setState('cart', array());
		$this->redirect(array('view', 'id' => $model->primaryKey));
	}
}