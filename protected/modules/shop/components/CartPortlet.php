<?php
Yii::import('zii.widgets.CPortlet');
class CartPortlet extends CPortlet {
	
	protected function renderContent()
	{
		$ids = Yii::app()->user->getState('cart', array());
	       		
    	$items = SanPham::model()->findAllByPk(array_keys($ids));
    	$this->render('cart', array('items' => $items));
	}
}