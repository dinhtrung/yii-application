<?php
/**
 * This is the model class for table "sanPham_donHang".
 *
 * The followings are the available columns in table 'sanPham_donHang':
 * @property integer $spid
 * @property string $donHang
 * @property integer $soLuong
 * @property double $donGiaSp
 */
class SanPhamDonHang extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SanPhamDonHang the static model class
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
		return '{{sanPham_donHang}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			array('spid, donHang, soLuong, donGiaSp', 'required'),
			array('spid, soLuong', 'numerical', 'integerOnly'=>true),
			array('donGiaSp', 'numerical'),
			array('donHang', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('spid, donHang, soLuong, donGiaSp', 'safe', 'on'=>'search'),
			// Unique Key Validator
			array('spid', 'unique', 'criteria' => array(
				'condition' => 'donHang=:dh', 
				'params' => array(':dh' => $this->donHang)
			)),
		);
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'spid' => 'integer',	// 
			'donHang' => 'string',	// 
			'soLuong' => 'integer',	// 
			'donGiaSp' => 'double',	// 
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('spid_donHang', $this->tableName(), 'spid, donHang')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}
}