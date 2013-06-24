<?php
class BaseActiveRecord extends MultiActiveRecord {
	public $dbtable;
	protected $_attributeLabels;
	public static $relations = array();

	/**
	 * Invoke the createTable() method of a model to install it.
	 * @param string $scenario
	 * @throws CDbException
	 */
	public function __construct($scenario = 'insert'){
		try {
			return parent::__construct($scenario);
		} catch (CDbException $e){
			if (! $this->createTable()) throw $e;
			$this->refreshMetaData();
			return parent::__construct($scenario);
		}
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	/**
	 * Display the Model as a string.
	 * Convenient when using in CGridView, CDetailView or just CHtml::encode()
	 * @return string
	 */
	public function  __toString() {
		if (Yii::app() instanceof CWebApplication){
			return CVarDumper::dumpAsString($this->getAttributes(), 3, TRUE);
		} else {
			return CVarDumper::dumpAsString($this->getAttributes(), 3, FALSE);
		}
	}

	/**
	 * Return attribute label for an attribute
	 * @see CActiveRecord::getAttributeLabel()
	 */
	public function getAttributeLabel($attribute){
		return Yii::t(basename(realpath(__DIR__ . '/../')), ucfirst($attribute));
	}

    /**
     * Return the default dataProvider for searching
     * Support search For every columns in the current database table
     */
    public function search($criteria = NULL){
    	if (is_null($criteria)) $criteria=new CDbCriteria;
    	foreach ($this->tableSchema->columns as $col){
    		if ($col->type == 'string') $criteria->compare($col->name, $this->{$col->name}, TRUE);
    		else $criteria->compare($col->name, $this->{$col->name});
    	}
    	return new CActiveDataProvider(get_class($this), array(
    			'criteria'=>$criteria,
    	));
    }
    
    /**
     * Return default rules generated by Gii
     * @see CModel::rules()
     */
    public function rules(){
    	$rules=array();
    	$required=array();
    	$integers=array();
    	$numerical=array();
    	$length=array();
    	$safe=array();
    	foreach($this->tableSchema->columns as $column)
    	{
    		if($column->autoIncrement) continue;		// No rule for auto increment column
    		$r=!$column->allowNull && $column->defaultValue===null;
    		if($r) $required[]=$column->name;
    		if($column->type==='integer') $integers[]=$column->name;
    		elseif($column->type==='double') $numerical[]=$column->name;
    		elseif($column->type==='string' && $column->size>0) $length[$column->size][]=$column->name;
    		elseif(!$column->isPrimaryKey && !$r) $safe[]=$column->name;
    	}
    	if($required!==array()) $rules[]=array(implode(', ',$required), 'required');
    	if($integers!==array()) $rules[]=array(implode(', ',$integers), 'numerical', 'integerOnly'=>true);
    	if($numerical!==array()) $rules[]=array(implode(', ',$numerical), 'numerical');
    	if($length!==array()) {
    		foreach($length as $len=>$cols) $rules[]=array(implode(', ',$cols), 'length', 'max'=>$len);
    	}
    	if($safe!==array()) $rules[]=array(implode(', ',$safe), 'safe');
    	Yii::trace(CVarDumper::dumpAsString($rules), 'BaseActiveRecord');
    	return $rules;
    }


    /**
     * Create the table if needed
     *
    pk: an auto-incremental primary key type, will be converted into "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY"
    string: string type, will be converted into "varchar(255)"
    text: a long string type, will be converted into "text"
    integer: integer type, will be converted into "int(11)"
    boolean: boolean type, will be converted into "tinyint(1)"
    float: float number type, will be converted into "float"
    decimal: decimal number type, will be converted into "decimal"
    datetime: datetime type, will be converted into "datetime"
    timestamp: timestamp type, will be converted into "timestamp"
    time: time type, will be converted into "time"
    date: date type, will be converted into "date"
    binary: binary data type, will be converted into "blob"
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'body'	=>	'text',
				'status'	=>	'boolean',
				'comment_cnt'	=>	'int',
				'rating'		=>	'float',
		);
		try {
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addPrimaryKey('id_lang', $this->tableName(), 'id,language')
			)->execute();
			// Reference tables
			$ref = new RefTable();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addForeignKey('fk_block_blocktheme', $this->tableName(), 'bid', $ref->tableName(), 'block')
			)->execute();
		} catch (CDbException $e){ Yii::log($e->getMessage(), 'warning'); }
		$this->refreshMetaData();
     */
    protected function createTable(){
    	return FALSE;
    }
}