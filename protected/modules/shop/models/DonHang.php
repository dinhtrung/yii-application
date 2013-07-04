<?php
/**
 * This is the model class for table "donHang".
 *
 * The followings are the available columns in table 'donHang':
 * @property string $maDonHang
 * @property integer $uid
 * @property integer $ngayTao
 * @property string $ghiChu
 * @property integer $trangThai
 */
class DonHang extends BaseActiveRecord
{
	const STATUS_PENDING 	= -1;
	const STATUS_PROCESSING = 0;
	const STATUS_DONE = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @return DonHang the static model class
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
		return '{{donHang}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sp' => array(self::HAS_MANY, 'sanPham_donHang', 'donHang'),
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
			array('maDonHang, uid, ngayTao, ghiChu, trangThai', 'required'),
			array('uid, ngayTao, trangThai', 'numerical', 'integerOnly'=>true),
			array('maDonHang', 'length', 'max'=>64),
			array('maDonHang', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('maDonHang, uid, ngayTao, ghiChu, trangThai', 'safe', 'on'=>'search'),
			// Relations
			array('sp', 'safe', 'on' => 'insert,update'),		
		);
	}

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'maDonHang' => 'string',	// MaDonHang
			'uid' => 'integer',	// 
			'ngayTao' => 'integer',	// 
			'ghiChu' => 'string',	// 
			'trangThai' => 'integer',	// 
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('maDonHang', $this->tableName(), 'maDonHang')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}
}