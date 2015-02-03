<?php

class m150203_202948_add_route_table extends CDbMigration
{
	public function up()
	{
            $this->addTable('tbl_route', array(
               'id'=>'pk',
                'permanent_id'=>'string DEFAULT NULL',
                'name'=>'string NOT NULL',
                'description'=>'string DEFAULT NULL',
                'drivetime'=>'float DEFAULT NULL',
                'delaytime'=>'float DEFAULT NULL',
                'length'=>'int NOT NULL',
                'jamfactor'=>'float DEFAULT NULL',
                'jamfactor_trend'=>'float DEFAULT NULL',
                'path'=>'text DEFAULT NULL'
            ));
	}

	public function down()
	{
	    $this->truncateTable('tbl_route');
            $this->dropTable('tbl_route');
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