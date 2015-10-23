<?php

use yii\db\Schema;
use yii\db\Migration;

class m151022_113507_order   extends Migration
{
    public $tableName = 'tbl_series';
    public $attributeName = 'order';
    public function up()
    {
        $this->addColumn($this->tableName, $this->attributeName, Schema::TYPE_SMALLINT . ' NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, $this->attributeName);
    }
}
