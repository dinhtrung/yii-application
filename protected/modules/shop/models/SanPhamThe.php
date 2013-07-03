<?php
/**
 * This is the model class for table "sanPham_the".
 *
 * The followings are the available columns in table 'sanPham_the':
 * @property integer $spid
 * @property integer $tid
 */
class SanPhamThe extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SanPhamThe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the CDbConnection component used for this module
	 */
	public function connectionId(){
		return Yii::app()->hasComponent('shopDb')?'shopDb':'db';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sanPham_the}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sp'	=>	array(self::BELONGS_TO, 'SanPham', 'id'),
			'the'	=>	array(self::BELONGS_TO, 'ThePhanLoai', 'id'),
		);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spid, tid', 'required'),
			array('spid, tid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('spid, tid', 'safe', 'on'=>'search'),
			// Unique Key Validator
			array('tid', 'unique', 'criteria' => array(
				'condition' => 'spid=:spid', 
				'params' => array(':spid' => $this->spid)
			)),
		);
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'spid' => 'integer',	// 
			'tid' => 'integer',	// 
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('spid_tid', $this->tableName(), 'spid, tid')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}
}