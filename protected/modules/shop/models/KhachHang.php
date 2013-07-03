<?php
/**
 * This is the model class for table "khachHang".
 *
 * The followings are the available columns in table 'khachHang':
 * @property integer $uid
 * @property integer $soDienThoai
 * @property string $diaChi
 */
class KhachHang extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return KhachHang the static model class
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
		return '{{khachHang}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'taiKhoan'	=>	array(self::BELONGS_TO, 'User', 'uid')
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
			array('uid, soDienThoai, diaChi', 'required'),
			array('uid, soDienThoai', 'numerical', 'integerOnly'=>true),
			array('diaChi', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, soDienThoai, diaChi', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'uid' => 'integer',	// 
			'soDienThoai' => 'integer',	// 
			'diaChi' => 'string',	// 
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('uid', $this->tableName(), 'uid')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}
}