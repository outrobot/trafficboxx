<?php

class m150204_194249_add_avgspeed_to_route extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tbl_route', 'average_speed', 'int DEFAULT NULL');
	}

	public function down()
	{
		echo "m150204_194249_add_avgspeed_to_route does not support migration down.\n";
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