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
	}

	function filters() {
		return array(
			array('rights.components.RightsFilter'),
//			"Language",
//			array(
//            	"ext.components.ESetReturnUrlFilter + index, admin, view",
//			)
        );
	}
	
	
	/**
	* @return string the actions that are always allowed separated by commas.
	*/
	public function allowedActions()
	{
		return '';
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
	/**
	 * Render the view
	 * 
	 * If this is an ajax request, we only display the minimum page by using renderPartial.
	 * If this is a full page, we display them along with blocks configured by system.
	 * @see CController::render()
	 */
	function render($view, $data = NULL, $return = FALSE) {
		if (Yii::app()->request->isAjaxRequest){
			$this->renderPartial($view, $data);
		} else {
			if (Yii::app()->hasModule('core')) $this->renderBlocks();
			$this->renderMenus();
			parent::render($view, $data, $return);
		}
	}

	/**
	 * Render all the blocks configured from Database
	 */
	protected function renderBlocks() {
		if (! Yii::app()->hasModule('core')) return;
		$blockTypes = new BlockType('search');
		$blocks = new Block('search');
		$blockTheme = new BlockTheme('search');
		$theme = (Yii::app()->theme instanceof CTheme)?Yii::app()->theme->name:Yii::app()->theme;
		$blocks = $blockTheme->with('owner')->findAllByAttributes( array("theme" => $theme) );
		foreach ($blocks as $block){
			if (array_key_exists($block->region, $this->page))
				$this->page[$block->region] .= $block->owner->render();
			else 
				$this->page[$block->region] = $block->owner->render();
		}
	}
	/**
	 * Render the menu provided by system and modules
	 * Load all modules/views/layouts/_menu files to render the global file
	 */
	protected function renderMenus(){
		$modules = Yii::app()->getModules();
		try {
			Yii::app()->getController()->renderPartial("//layouts/_menu");
		} catch (CException $e){
			Yii::log('Catch error while loading module menu: '.$e->getMessage(), 'debug');
		}
		foreach ($modules as $m => $info){
			try {
				Yii::app()->getController()->renderPartial("//../modules/$m/views/layouts/_menu".ucfirst($m));
			} catch (CException $e){
				Yii::trace('Missing module Menu: '."//../modules/$m/views/layouts/_menu".ucfirst($m), 'webBaseController');
			}
		}
	}
}
