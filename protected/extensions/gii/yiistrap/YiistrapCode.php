<?php
/**
 * BootstrapCode class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.gii
 */

Yii::import('gii.CCodeModel');
class YiistrapCode extends CCodeModel
{
	public $model;
	public $controller;
	public $baseControllerClass='WebBaseController';

	private $_modelClass;
	private $_table;

	public function rules()
	{
		return array_merge(parent::rules(), array(
				array('model, controller', 'filter', 'filter'=>'trim'),
				array('model, controller, baseControllerClass', 'required'),
				array('model', 'match', 'pattern'=>'/^\w+[\w+\\.]*$/', 'message'=>'{attribute} should only contain word characters and dots.'),
				array('controller', 'match', 'pattern'=>'/^\w+[\w+\\/]*$/', 'message'=>'{attribute} should only contain word characters and slashes.'),
				array('baseControllerClass', 'match', 'pattern'=>'/^[a-zA-Z_][\w\\\\]*$/', 'message'=>'{attribute} should only contain word characters and backslashes.'),
				array('baseControllerClass', 'validateReservedWord', 'skipOnError'=>true),
				array('model', 'validateModel'),
				array('baseControllerClass', 'sticky'),
		));
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
				'model'=>'Model Class',
				'controller'=>'Controller ID',
				'baseControllerClass'=>'Base Controller Class',
		));
	}

	public function requiredTemplates()
	{
		return array(
				'controller.php',
		);
	}

	public function init()
	{
		if(Yii::app()->db===null)
			throw new CHttpException(500,'An active "db" connection is required to run this generator.');
		parent::init();
	}

	public function successMessage()
	{
		$link=CHtml::link('try it now', Yii::app()->createUrl($this->controller), array('target'=>'_blank'));
		return "The controller has been generated successfully. You may $link.";
	}

	public function validateModel($attribute,$params)
	{
		if($this->hasErrors('model'))
			return;
		$class=@Yii::import($this->model,true);
		if(!is_string($class) || !$this->classExists($class))
			$this->addError('model', "Class '{$this->model}' does not exist or has syntax error.");
		elseif(!is_subclass_of($class,'CActiveRecord'))
		$this->addError('model', "'{$this->model}' must extend from CActiveRecord.");
		else
		{
			$table=CActiveRecord::model($class)->tableSchema;
			if($table->primaryKey===null)
				$this->addError('model',"Table '{$table->name}' does not have a primary key.");
			else
			{
				$this->_modelClass=$class;
				$this->_table=$table;
			}
		}
	}

	public function prepare()
	{
		$this->files=array();
		$templatePath=$this->templatePath;
		$controllerTemplateFile=$templatePath.DIRECTORY_SEPARATOR.'controller.php';

		$this->files[]=new CCodeFile(
				$this->controllerFile,
				$this->render($controllerTemplateFile)
		);

		$files=scandir($templatePath);
		foreach($files as $file)
		{
			if(is_file($templatePath.'/'.$file) && CFileHelper::getExtension($file)==='php' && $file!=='controller.php')
			{
				$this->files[]=new CCodeFile(
						$this->viewPath.DIRECTORY_SEPARATOR.basename($file, '.php') . $this->_modelClass . '.php',
						$this->render($templatePath.'/'.$file)
				);
			}
		}
	}

	public function getModelClass()
	{
		return $this->_modelClass;
	}

	public function getControllerClass()
	{
		if(($pos=strrpos($this->controller,'/'))!==false)
			return ucfirst(substr($this->controller,$pos+1)).'Controller';
		else
			return ucfirst($this->controller).'Controller';
	}

	public function getModule()
	{
		if(($pos=strpos($this->controller,'/'))!==false)
		{
			$id=substr($this->controller,0,$pos);
			if(($module=Yii::app()->getModule($id))!==null)
				return $module;
		}
		return Yii::app();
	}

	public function getControllerID()
	{
		if($this->getModule()!==Yii::app())
			$id=substr($this->controller,strpos($this->controller,'/')+1);
		else
			$id=$this->controller;
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtolower($id[$pos+1]);
		else
			$id[0]=strtolower($id[0]);
		return $id;
	}

	public function getUniqueControllerID()
	{
		$id=$this->controller;
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtolower($id[$pos+1]);
		else
			$id[0]=strtolower($id[0]);
		return $id;
	}

	public function getControllerFile()
	{
		$module=$this->getModule();
		$id=$this->getControllerID();
		if(($pos=strrpos($id,'/'))!==false)
			$id[$pos+1]=strtoupper($id[$pos+1]);
		else
			$id[0]=strtoupper($id[0]);
		return $module->getControllerPath().'/'.$id.'Controller.php';
	}

	public function getViewPath()
	{
		return $this->getModule()->getViewPath().'/'.$this->getControllerID();
	}

	public function getTableSchema()
	{
		return $this->_table;
	}


	public function guessNameColumn($columns)
	{
		foreach($columns as $column)
		{
			if(!strcasecmp($column->name,'name'))
				return $column->name;
		}
		foreach($columns as $column)
		{
			if(!strcasecmp($column->name,'title'))
				return $column->name;
		}
		foreach($columns as $column)
		{
			if($column->isPrimaryKey)
				return $column->name;
		}
		return 'id';
	}


	/**
	 * Generate YiiStrap Active Control Group
	 * @param unknown $modelClass
	 * @param unknown $column
	 * @return string
	 */
	public function generateActiveControlGroup($modelClass, $column)
	{
		if ($column->type === 'boolean')
			return "\$form->checkBoxControlGroup(\$model,'{$column->name}')";
		else if (stripos($column->dbType,'text') !== false)
			return "\$form->textAreaControlGroup(\$model,'{$column->name}',array('rows'=>6,'span'=>8))";
		else
		{
			if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
				$inputField='passwordFieldControlGroup';
			elseif (preg_match('/email/i',$column->name))
				$inputField='emailFieldControlGroup';
			else
				$inputField='textFieldControlGroup';
			
			// Tune up some other name...
			switch ($column->dbType){
				case 'date':
				case 'datetime':
					$inputField='dateFieldControlGroup';
					break;
				case 'int':
				case 'double':
				case 'float':
					$inputField='numberFieldControlGroup';
					break;
					
			}

			if ($column->type!=='string' || $column->size===null)
				return "\$form->{$inputField}(\$model,'{$column->name}',array('span'=>5))";
			else
				return "\$form->{$inputField}(\$model,'{$column->name}',array('span'=>5,'maxlength'=>$column->size))";
		}
	}
}