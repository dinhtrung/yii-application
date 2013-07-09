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
	 * @return string the associated database table the
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
		// NOTE: you may need to adjust the relation the and the related
		// class the for the relations automatically generated below.
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
	
	public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}
	
	public static function array2string($tags)
	{
		return implode(', ',$tags);
	}
	
	public function updateFrequency($oldTags, $newTags, $pk = NULL)
	{
		$oldTags=self::string2array($oldTags);
		$newTags=self::string2array($newTags);
		$this->addTags(array_values(array_diff($newTags,$oldTags)), $pk);
		$this->removeTags(array_values(array_diff($oldTags,$newTags)), $pk);
	}
	
	public function addTags($tags, $spid)
	{
		$criteria=new CDbCriteria;
		$criteria->addInCondition('the',$tags);
		$this->updateCounters(array('soLuong'=>1),$criteria);
		foreach($tags as $the)
		{
			if(!$this->exists('the=:the',array(':the'=>$the)))
			{
				$tag=new ThePhanLoai();
				$tag->the=$the;
				$tag->soLuong=1;
				$tag->save();
			}
		}
		$models = $this->query($criteria, TRUE);
		foreach ($models as $tag){
			$join = new SanPhamThe();
			$join->tid = $tag->id;
			$join->spid = $spid;
			$join->save();
		}
	}
	
	public function removeTags($tags, $spid)
	{
		if(empty($tags)) return;
		// Delete the join tables
		$criteria=new CDbCriteria;
		$criteria->join = 'JOIN {{sanPham_the}} ON id = tid';
		$criteria->addInCondition('the',$tags);
		$criteria->addCondition("spid=$spid");
		$joinRow = SanPhamThe::model()->query($criteria, TRUE);
		foreach ($joinRow as $r) $r->delete();
		
		$this->updateCounters(array('soLuong'=>-1),$criteria);
		$this->deleteAll('soLuong<=0');
		// Delete the main table
		$criteria=new CDbCriteria;
		$criteria->addInCondition('the',$tags);
		$this->updateCounters(array('soLuong'=>-1),$criteria);
		$this->deleteAll('soLuong<=0');
	}
}