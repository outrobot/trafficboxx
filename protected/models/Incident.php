<?php

/**
 * This is the model class for table "tbl_incident".
 *
 * The followings are the available columns in table 'tbl_incident':
 * @property integer $id
 * @property string $description
 * @property string $location
 * @property integer $criticality
 * @property string $type
 * @property string $direction
 * @property string $type_description
 * @property double $gps_lat
 * @property double $gps_lng
 * @property string $start_time
 * @property string $end_time
 * @property string $create_time
 * @property string $update_time
 */
class Incident extends CActiveRecord
{
        const TYPE_UNKNOWN = 0;
        
        const TYPE_CONSTRUCTION = 1;
        const TYPE_ACCIDENT = 2;
        const TYPE_TRANSIT = 3;
        const TYPE_ALERT = 4;
        const TYPE_FIRE = 5;
        const TYPE_POLICEACTIVITY = 6;
        const TYPE_GAME = 7;
        const TYPE_DISABLED_VEHICLE = 8;
        const TYPE_WIRES = 9;
        const TYPE_RACE = 10;
        const TYPE_WATER = 11;
        const TYPE_CONST_ONGO = 12;
        const TYPE_BRIDGE = 13;
        const TYPE_EVENT = 14;
        const TYPE_TUNNEL = 15;
        
        const TYPE_NAME_CONSTRUCTION = 'CONST';
        const TYPE_NAME_ACCIDENT = 'ACC';
        const TYPE_NAME_TRANSIT = 'TRANSIT';
        const TYPE_NAME_ALERT = 'ALRT';
        const TYPE_NAME_FIRE = 'FIRE';
        const TYPE_NAME_POLICEACTIVITY = 'PA';
        const TYPE_NAME_GAME = 'GAME';
        const TYPE_NAME_DISABLED_VEHICLE = 'DVEH';
        const TYPE_NAME_WIRES_DOWN = 'WIRES';
        const TYPE_NAME_RACE = 'RACE';
        const TYPE_NAME_WATER_BREAK = 'WATER';
        const TYPE_NAME_CONSTRUCTION_ONGOING = 'ONGO';
        const TYPE_NAME_BRIDGE_REPAIR = 'BRIDGE';
        const TYPE_NAME_EVENT = 'EVENT';
        const TYPE_NAME_TUNNEL_REPAIR = 'TUNNEL';

        
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_incident';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, create_time', 'required'),
			array('criticality', 'numerical', 'integerOnly'=>true),
			array('gps_lat, gps_lng', 'numerical'),
			array('description, location, type, direction, type_description', 'length', 'max'=>255),
			array('start_time, end_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, location, criticality, type, direction, type_description, gps_lat, gps_lng, start_time, end_time, create_time, update_time', 'safe', 'on'=>'search'),
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
			'description' => 'Description',
			'location' => 'Location',
			'criticality' => 'Criticality',
			'type' => 'Type',
			'direction' => 'Direction',
			'type_description' => 'Type Description',
			'gps_lat' => 'Gps Lat',
			'gps_lng' => 'Gps Lng',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('criticality',$this->criticality);
		$criteria->compare('type',$this->type);
		$criteria->compare('direction',$this->direction,true);
		$criteria->compare('type_description',$this->type_description,true);
		$criteria->compare('gps_lat',$this->gps_lat);
		$criteria->compare('gps_lng',$this->gps_lng);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Incident the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTypeId($typeString)
        {
            $typeArray = array(
                0 => 'Select',
                self::TYPE_NAME_ACCIDENT => self::TYPE_ACCIDENT,
                self::TYPE_NAME_ALERT => self::TYPE_ALERT,
                self::TYPE_NAME_CONSTRUCTION => self::TYPE_CONSTRUCTION,
                self::TYPE_NAME_DISABLED_VEHICLE => self::TYPE_DISABLED_VEHICLE,
                self::TYPE_NAME_FIRE => self::TYPE_FIRE,
                self::TYPE_NAME_GAME => self::TYPE_GAME,
                self::TYPE_NAME_POLICEACTIVITY => self::TYPE_POLICEACTIVITY,
                self::TYPE_NAME_TRANSIT => self::TYPE_TRANSIT,
                self::TYPE_NAME_WIRES_DOWN => self::TYPE_WIRES,
                self::TYPE_NAME_RACE => self::TYPE_RACE,
                self::TYPE_NAME_WATER_BREAK => self::TYPE_WATER,
                self::TYPE_NAME_CONSTRUCTION_ONGOING => self::TYPE_CONST_ONGO,
                self::TYPE_NAME_BRIDGE_REPAIR => self::TYPE_BRIDGE,
                self::TYPE_NAME_EVENT => self::TYPE_EVENT,
                self::TYPE_NAME_TUNNEL_REPAIR => self::TYPE_TUNNEL
            );
            
            return array_key_exists($typeString, $typeArray) ? $typeArray[$typeString] : self::TYPE_UNKNOWN;
        }
        
        public function getTypeText()
        {
            $typeArray = array(
                self::TYPE_ACCIDENT => self::TYPE_NAME_ACCIDENT,
                self::TYPE_ALERT => self::TYPE_NAME_ALERT,
                self::TYPE_CONSTRUCTION => self::TYPE_NAME_CONSTRUCTION,
                self::TYPE_DISABLED_VEHICLE => self::TYPE_NAME_DISABLED_VEHICLE,
                self::TYPE_FIRE => self::TYPE_NAME_FIRE,
                self::TYPE_GAME => self::TYPE_NAME_GAME,
                self::TYPE_POLICEACTIVITY => self::TYPE_NAME_POLICEACTIVITY,
                self::TYPE_TRANSIT => self::TYPE_NAME_TRANSIT,
                self::TYPE_WIRES => self::TYPE_NAME_WIRES_DOWN,
                self::TYPE_RACE => self::TYPE_NAME_RACE,
                self::TYPE_WATER => self::TYPE_NAME_WATER_BREAK,
                self::TYPE_CONST_ONGO => self::TYPE_NAME_CONSTRUCTION_ONGOING,
                self::TYPE_BRIDGE => self::TYPE_NAME_BRIDGE_REPAIR,
                self::TYPE_EVENT => self::TYPE_NAME_EVENT,
                self::TYPE_TUNNEL => self::TYPE_NAME_TUNNEL_REPAIR
            );
            
            return array_key_exists($this->type, $typeArray) ? $typeArray[$this->type] : 'Unknown';
        }
        
        public function getTypeOptions()
	{
                $typeArray = array(
                    self::TYPE_ACCIDENT => self::TYPE_NAME_ACCIDENT,
                    self::TYPE_ALERT => self::TYPE_NAME_ALERT,
                    self::TYPE_CONSTRUCTION => self::TYPE_NAME_CONSTRUCTION,
                    self::TYPE_DISABLED_VEHICLE => self::TYPE_NAME_DISABLED_VEHICLE,
                    self::TYPE_FIRE => self::TYPE_NAME_FIRE,
                    self::TYPE_GAME => self::TYPE_NAME_GAME,
                    self::TYPE_POLICEACTIVITY => self::TYPE_NAME_POLICEACTIVITY,
                    self::TYPE_TRANSIT => self::TYPE_NAME_TRANSIT,
                    self::TYPE_WIRES => self::TYPE_NAME_WIRES_DOWN,
                    self::TYPE_RACE => self::TYPE_NAME_RACE,
                    self::TYPE_WATER => self::TYPE_NAME_WATER_BREAK,
                    self::TYPE_CONST_ONGO => self::TYPE_NAME_CONSTRUCTION_ONGOING,
                    self::TYPE_BRIDGE => self::TYPE_NAME_BRIDGE_REPAIR,
                    self::TYPE_EVENT => self::TYPE_NAME_EVENT,
                    self::TYPE_TUNNEL => self::TYPE_NAME_TUNNEL_REPAIR
                );
		
		return $typeArray;
	}
}
