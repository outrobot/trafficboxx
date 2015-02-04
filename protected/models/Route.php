<?php

/**
 * This is the model class for table "tbl_route".
 *
 * The followings are the available columns in table 'tbl_route':
 * @property integer $id
 * @property string $permanent_id
 * @property string $name
 * @property string $description
 * @property double $drivetime
 * @property double $delaytime
 * @property integer $length
 * @property double $jamfactor
 * @property double $jamfactor_trend
 * @property string $path
 * @property string $update_time
 * @property integer $average_speed
 */
class Route extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_route';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, length, update_time', 'required'),
			array('length, average_speed', 'numerical', 'integerOnly'=>true),
			array('drivetime, delaytime, jamfactor, jamfactor_trend', 'numerical'),
			array('permanent_id, name, description', 'length', 'max'=>255),
			array('path', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, permanent_id, name, description, drivetime, delaytime, length, jamfactor, jamfactor_trend, path, update_time, average_speed', 'safe', 'on'=>'search'),
		);
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'permanent_id' => 'Permanent',
			'name' => 'Name',
			'description' => 'Description',
			'drivetime' => 'Drivetime',
			'delaytime' => 'Delaytime',
			'length' => 'Length',
			'jamfactor' => 'Jamfactor',
			'jamfactor_trend' => 'Jamfactor Trend',
			'path' => 'Path',
			'update_time' => 'Update Time',
			'average_speed' => 'Average Speed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('permanent_id',$this->permanent_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('drivetime',$this->drivetime);
		$criteria->compare('delaytime',$this->delaytime);
		$criteria->compare('length',$this->length);
		$criteria->compare('jamfactor',$this->jamfactor);
		$criteria->compare('jamfactor_trend',$this->jamfactor_trend);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('average_speed',$this->average_speed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Route the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
