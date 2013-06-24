<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
abstract class WebBaseController extends BaseController
{
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $mainMenu=array();
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/**
	 * @var string Current page title, used in the header <head> tags
	 */
	public $pageTitle;
	/**
	 * @var array contain various regional contents
	 */
	public $page = array();
	/* (non-PHPdoc)
	 * @see CController::init()
	 */
	public function init() {
		parent::init();
		/*
		 * Load all modules/views/layouts/_menu files to render the global file
		 */
		$this->mainMenu = array();
		$modules = Yii::app()->getModules();
		try {
			Yii::app()->getController()->renderPartial("//layouts/_menu");
		} catch (CException $e){
			Yii::log('Catch error while loading module menu: '.$e->getMessage(), 'debug');
		}
		foreach ($modules as $m => $info){
			try {
				Yii::app()->getController()->renderPartial("//../modules/$m/views/layouts/_menu");
			} catch (CException $e){
				Yii::log('Catch error while loading module menu: '.$e->getMessage(), 'debug');
			}
		}
	}

	function filters() {
		return array(
			array('ext.components.AuthFilter + admin, update, create, delete'),
//			"Language",
// 			"Rights",
//			array(
//            	"ext.components.ESetReturnUrlFilter + index, admin, view",
//			)
        );
	}

	/**
	 * Perform Ajax Validation
	 * @param CModel $model	: The model to perform validation
	 * @param string $form  : The ID of the form
	 */
	protected function performAjaxValidation($model, $form) {
		if(isset($_POST['ajax']) && $_POST['ajax'] == $form) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	function render($view, $data = NULL, $return = FALSE, $renderBlock = TRUE) {
		if (Yii::app()->request->isAjaxRequest){
			$this->renderPartial($view, $data);
		} else {
			if ($renderBlock && Yii::app()->hasModule('core')){
				$this->renderBlocks();
			}
			parent::render($view, $data, $return);
		}
	}

	protected function renderBlocks() {
		$blockTypes = new Blocktype('search');
		$blocks = new Block('search');
		$blockTheme = new Blocktheme('search');
		$theme = (Yii::app()->theme instanceof CTheme)?Yii::app()->theme->name:Yii::app()->theme;
		$blocks = $blockTheme->with('owner')->findAllByAttributes(
				array("theme" => $theme)
			);
		foreach ($blocks as $block){
			if (array_key_exists($block->region, $this->page))
				$this->page[$block->region] .= $block->owner->render();
			else 
				$this->page[$block->region] = $block->owner->render();
		}
	}
}
