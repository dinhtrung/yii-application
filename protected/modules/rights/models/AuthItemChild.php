<?php
/**
 * * CDbAuthManager AuthItemChild table
 * @author dinhtrung
 *
 */
class AuthItemChild extends BaseActiveRecord
{
	public function connectionId(){
		return Yii::app()->hasComponent('rightsDb')?'rightsDb':'db';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName(){
		return '{{authitemchild}}';
	}


	public function relations(){
		return array(
			'parentItem' => array(self::HAS_ONE, 'Authitem', 'parent'),
			'childItem' => array(self::HAS_ONE, 'Authitem', 'child'),
		);
	}

	/*
	 * Auth item child
	 */
	protected function createTable(){
		$columns = array (
		  'parent' => 'string',
		  'child' => 'string',
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('parent_child', $this->tableName(), 'parent,child')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		// Relation of child and parent
		try {
			$ref = new AuthItem();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addForeignKey('parent_item', $this->tableName(), 'parent', $ref->tableName(), 'name')
			)->execute();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addForeignKey('child_item', $this->tableName(), 'child', $ref->tableName(), 'name')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		$this->refreshMetaData();
	}
}
