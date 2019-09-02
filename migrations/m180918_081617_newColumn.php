<?php
namespace execut\shops\migrations;

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m180918_081617_newColumn extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('shops_shops')
            ->addColumn('schema_md5', $this->string(64))
            ->addColumn('image_md5', $this->string(64))
            ->addColumn('sort', $this->integer());
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
