<?php

class m150204_192309_add_incident_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_incident', array(
               'id'=>'pk',
                'description'=>'string DEFAULT NULL',
                'location'=>'string DEFAULT NULL',
                'criticality'=>'int DEFAULT NULL',
                'type'=>'string NOT NULL',
                'direction'=>'string DEFAULT NULL',
                'type_description'=>'string DEFAULT NULL',
                'gps_lat'=>'float DEFAULT NULL',
                'gps_lng'=>'float DEFAULT NULL',
                'start_time'=>'datetime DEFAULT NULL',
                'end_time'=>'datetime DEFAULT NULL',
                'create_time'=>'datetime NOT NULL',
                'update_time'=>'datetime DEFAULT NULL'
            ));
	}

	public function down()
	{
		echo "m150204_192309_add_incident_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}