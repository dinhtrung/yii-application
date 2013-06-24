<?php 
/**
 * EMessageSource
 */
class EMessageSource extends CMessageSource {
	public $sources = array('CPhpMessageSource');
	
	/**
	 * Load all available sources and its configuration
	 * @see CApplicationComponent::init()
	 */
	public function init(){
		foreach ($this->sources as $componentId => $config){
			Yii::app()->setComponent($componentId, $config);
			if (Yii::app()->getComponent($componentId) instanceof CDbMessageSource){
				// Create the table if needed...
				$src = new MessageSource();
				$dst = new Message();
			} elseif(Yii::app()->getComponent($componentId) instanceof CMessageSource){
				Yii::trace("New CMessageSource component created: ". $componentId);
			} else {
				throw new CHttpException(500, "Please re-config your EMessageSource... Read the README.md for more information... Noobs!");
			}
		}
		return parent::init();
	}
	
	protected function loadMessages($category, $language){
	
	}
	
	public function translate($category, $message, $language = NULL){
		foreach ($this->sources as $componentId => $config){
			if (Yii::app()->getComponent($componentId) instanceof CMessageSource){
				$translated = Yii::app()->getComponent($componentId)->translate($category, $message, $language);
				if ($translated != $message) return $translated;
			}
		}
		return $translated;
	}
}

?>