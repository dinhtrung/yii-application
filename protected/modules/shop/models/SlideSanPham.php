<?php
/**
 * This is the model class for table "slideSanPham".
 *
 * The followings are the available columns in table 'slideSanPham':
 * @property integer $spid
 * @property integer $thuTu
 * @property string $tenFile
 */
class SlideSanPham extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SlideSanPham the static model class
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
		return '{{slideSanPham}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sp' => array(self::BELONGS_TO, 'SanPham', 'spid'),
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
			array('spid, thuTu, tenFile', 'required'),
			array('spid, thuTu', 'numerical', 'integerOnly'=>true),
			array('tenFile', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('spid, thuTu, tenFile', 'safe', 'on'=>'search'),
			// Relations
			array('sp', 'safe', 'on' => 'insert,update'),		
			// Unique Key Validator: tenFile+spid
			array('tenFile', 'unique', 'criteria' => array(
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
			'thuTu' => 'integer',	// 
			'tenFile' => 'string',	// 
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('spid_thuTu', $this->tableName(), 'spid, thuTu')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}
}