<?php
/**
 * This is the model class for table "thePhanLoai".
 *
 * The followings are the available columns in table 'thePhanLoai':
 * @property integer $id
 * @property string $the
 * @property integer $soLuong
 */
class ThePhanLoai extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ThePhanLoai the static model class
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
		return '{{thePhanLoai}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sp' => array(self::MANY_MANY, 'SanPham', 'sanPham_the(tid, spid)'),
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
			array('the, soLuong', 'required'),
			array('soLuong', 'numerical', 'integerOnly'=>true),
			array('the', 'length', 'max'=>255),
			array('the', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, the, soLuong', 'safe', 'on'=>'search'),
			// Relations
			array('sp', 'safe', 'on' => 'insert,update'),		
		);
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'id' => 'integer',	// 
			'the' => 'string',	// 
			'soLuong' => 'integer',	// 
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('id', $this->tableName(), 'id')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}
}