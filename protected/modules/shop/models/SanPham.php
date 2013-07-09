<?php
/**
 * This is the model class for table "sanPham".
 *
 * The followings are the available columns in table 'sanPham':
 * @property integer $id
 * @property string $tenSanPham
 * @property string $moTa
 * @property string $anh
 * @property double $giaBan
 * @property integer $thoiGianTao
 * @property integer $thoiGianSua
 * @property integer $loaiSanPham
 */
Yii::import('ext.helpers.*');
class SanPham extends BaseActiveRecord
{
	public static $thumbDir = 'webroot.files.sanpham.thumbnails';
	public static $thumbUrl = '/files/sanpham/thumbnails';
	public static $slideDir = 'webroot.files.sanpham.slides';
	public static $slideUrl = '/files/sanpham/slides';
	public $tags = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @return SanPham the static model class
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
		return '{{sanPham}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'loai' => array(self::BELONGS_TO, 'LoaiSanPham', 'loaiSanPham'),
			'daDatHang' => array(self::MANY_MANY, 'DonHang', 'sanPham_donHang(spid, donHang)'),
			'slide' => array(self::HAS_MANY, 'SlideSanPham', 'spid'),
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
			array('tenSanPham', 'required'),
			array('moTa', 'safe'),
			array('loaiSanPham', 'numerical', 'integerOnly'=>true),
			array('giaBan', 'numerical'),
			array('anh', 'file', 'allowEmpty'=>true, 'types'=>'jpg,jpeg,gif,png'),
			array('tenSanPham', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tenSanPham, moTa, anh, giaBan, thoiGianTao, thoiGianSua, loaiSanPham', 'safe', 'on'=>'search'),
			// Relations
			array('loai, daDatHang, slide, tags', 'safe', 'on' => 'insert,update'),		);
	}
	
	/**
	 * Return the path for slide images
	 */
	public function saveFile($file, $dir){
		if ($file instanceof CUploadedFile){
			$filename = Transliteration::file($file->name);
			$filePath = $dir . DIRECTORY_SEPARATOR . $filename;
			if (file_exists($filePath)){
				$i = 0;
				$ext = $file->getExtensionName();
				if ($ext) $prefix = substr($filename, 0, strpos($filename, $ext) - 1);
				while (file_exists($filePath = $dir .DIRECTORY_SEPARATOR . $prefix . '_' . $i . '.' . $ext)){
					$i++;
				}
			}
			DirectoryHelper::safe_directory(dirname($filePath));
			if ($file->saveAs($filePath)) return basename($filePath);
		}
		return NULL;
	}
	
	
	/**
	 * Add nestedSetBehavior to this
	 * @see CModel::behaviors()
	 */
	public function behaviors()
	{
		return array(
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
			'tenSanPham' => 'string',	// 
			'moTa' => 'string',	// 
			'anh' => 'string',	// 
			'giaBan' => 'double',	// 
			'thoiGianTao' => 'integer',	// 
			'thoiGianSua' => 'integer',	// 
			'loaiSanPham' => 'integer',	// 
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
	
	
	/**
	 * soLuong
	 */
	public function getSoLuong(){
		if (Yii::app()->user && ($cart = Yii::app()->user->getState('cart'))){
			if (array_key_exists($this->primaryKey, $cart)) return $cart[$this->primaryKey];
		}
		return NULL;
	}
	
	/**
	 * Return the tags attribute
	 */
	public function getTags(){
		$criteria = new CDbCriteria();
		$criteria->select = 'the';
		$criteria->join = 'LEFT JOIN {{sanPham_the}} ON t.id=tid';
		$criteria->condition = 'spid=:spid';
		$criteria->params = array(':spid' => $this->primaryKey);
		$tags = ThePhanLoai::model()->query($criteria, TRUE);
		return $tags;
	}
	/**
	 * Return the tag as string
	 */
	public function getTagString(){
		$tagString = array();
		$tags = $this->getTags();
		foreach ($tags as $t){
			$tagString[] = $t->the;
		}
		return implode(', ', $tagString);		
	}
}