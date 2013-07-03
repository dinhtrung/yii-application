<?php
/**
 * This is the model class for table "loaiSanPham".
 *
 * The followings are the available columns in table 'loaiSanPham':
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $thoiGianTao
 * @property integer $thoiGianSua
 * @property string $tieuDe
 * @property string $moTa
 */
class LoaiSanPham extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LoaiSanPham the static model class
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
		return '{{loaiSanPham}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sanPhams' => array(self::HAS_MANY, 'SanPham', 'loaiSanPham'),
			'thePhanLoais' => array(self::MANY_MANY, 'ThePhanLoai', 'sanPham_the(spid, tid)'),
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
			array('root, lft, rgt, level, thoiGianTao, thoiGianSua, tieuDe, moTa', 'required'),
			array('root, lft, rgt, level, thoiGianTao, thoiGianSua', 'numerical', 'integerOnly'=>true),
			array('tieuDe', 'length', 'max'=>255),
			array('tieuDe', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, root, lft, rgt, level, thoiGianTao, thoiGianSua, tieuDe, moTa', 'safe', 'on'=>'search'),
			// Relations
			array('sanPhams, thePhanLoais', 'safe', 'on' => 'insert,update'),		);
	}
	/**
	 * Add nestedSetBehavior to this
	 * @see CModel::behaviors()
	 */
	public function behaviors()
	{
		return array(
			'nestedSet' => array(
				'class'=>'ext.behaviors.NestedSetBehavior',
				'hasManyRoots'	=>	TRUE,
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
			),
			'timeStamp' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'thoiGianTao',
				'updateAttribute' => 'thoiGianSua',
			)
		);
	}
	

	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
			'id' => 'integer',	// 
			'root' => 'integer',	// 
			'lft' => 'integer',	// 
			'rgt' => 'integer',	// 
			'level' => 'integer',	// 
			'thoiGianTao' => 'integer',	// 
			'thoiGianSua' => 'integer',	// 
			'tieuDe' => 'string',	// 
			'moTa' => 'string',	// 
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