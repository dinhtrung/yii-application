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
		$allow = true;

		$user = Yii::app()->getUser();
		$controller = $filterChain->controller;
		$action = $filterChain->action;

		/**
		 * The authItem is [moduleId/]controlerId/actionId
		 */
		if( ($module = $controller->getModule())!==null ) $this->authItem .= $module->id.'/';
		$this->authItem .= $controller->id;
		$task = $this->authItem . '/*';
		$operation = $this->authItem .'/'.$action->id;
			
 		if (YII_DEBUG) Rights::getAuthorizer()->createAuthItem($task, CAuthItem::TYPE_TASK);
 		if (YII_DEBUG) Rights::getAuthorizer()->createAuthItem($operation, CAuthItem::TYPE_OPERATION);
		if (method_exists($controller, 'allowedActions')) $this->_allowedActions = $controller->allowedActions();
		
		if (is_string($this->_allowedActions)) {
			if ($this->_allowedActions == '*') return TRUE;
			$this->_allowedActions = explode(',', preg_replace('/\s+/', '', $this->_allowedActions));
		}
		// Check if the action should be allowed
		if(! in_array($action->id, $this->_allowedActions))
		{
			// Check if user has access to the controller
			if( $user->checkAccess($task)!== TRUE ) {
				// Check if the user has access to the controller action
				if( $user->checkAccess($operation)!== TRUE ){
					$allow = FALSE;
				}
			}
		}

		// User is not allowed access, deny access
		if( $allow == FALSE ) {
			if ($user->isGuest) $user->loginRequired();
			else throw new CHttpException(403, 'Access denied');
		}

		// Authorization item did not exist or the user had access, allow access
		return TRUE;
	}
}
