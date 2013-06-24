<?php
/**
* Rights filter class file.
*
* @author Christoffer Niska <cniska@live.com>
* @copyright Copyright &copy; 2010 Christoffer Niska
* @since 0.7
*/
class RightsFilter extends CFilter
{
	protected $_allowedActions;
	public $authItem = '';

	/**
	* Performs the pre-action filtering.
	* Add the following lines to your Controller:
	* 
	* public function filter(){
	* 	return array(
	* 		...
	* 		array('rights.components.RightsFilter + admin,create,update,delete')
	* 		...
	* 	);
	* }
	* 
	* @param CFilterChain $filterChain the filter chain that the filter is on.
	* @return boolean whether the filtering process should continue and the action
	* should be executed.
	*/
	protected function preFilter($filterChain)
	{
		// By default we assume that the user is allowed access
		$allow = true;

		$user = Yii::app()->getUser();
		if ($user->isGuest) $user->loginRequired();
		
		$controller = $filterChain->controller;
		$action = $filterChain->action;

		if (is_null($this->_allowedActions) && method_exists($controller, 'allowedActions')) 
			$this->_allowedActions = $controller->allowedActions();
		if (is_string($this->_allowedActions)) {
			if ($this->_allowedActions == '*') return TRUE;
			$this->_allowedActions = explode(',', preg_replace('/\s+/', '', $this->_allowedActions));
		}

		// Check if the action should be allowed
		if(in_array($action->id, $this->_allowedActions))
		{
			// Append the module id to the authorization item name
			// in case the controller called belongs to a module
			if( ($module = $controller->getModule())!==null )
				$this->authItem .= $module->id.'/';

			// Append the controller id to the authorization item name
			$this->authItem .= $controller->id;
			
			$task = $this->authItem . '/*';
			if (YII_DEBUG) Rights::getAuthorizer()->createAuthItem($task, CAuthItem::TYPE_TASK);

			// Check if user has access to the controller
			if( $user->checkAccess($task)!==true ) {
				// Append the action id to the authorization item name
				$operation = $this->authItem .'/'.$action->id;

				// Check if the user has access to the controller action
				if( $user->checkAccess($operation)!==true ){
					if (YII_DEBUG) Rights::getAuthorizer()->createAuthItem($operation, CAuthItem::TYPE_OPERATION);
					$allow = false;
				}
			}
		}

		// User is not allowed access, deny access
		if( $allow===false ) throw new CHttpException(403, 'Access denied');

		// Authorization item did not exist or the user had access, allow access
		return true;
	}
}
