<?php
namespace execut\shops\migrations;
use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m180918_071738_newColumns extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('shops_shops')
            ->addColumn('address', $this->string())
            ->update(['address' => '-'])
            ->alterColumnSetNotNull('address')
            ->addColumn('phone_1', $this->string())
            ->addColumn('phone_2', $this->string())
            ->addColumn('work_time', $this->string())
            ->addColumn('coords', $this->string())
            ->addColumn('text_header_map', $this->string())
            ->addColumn('specialization', $this->string())
            ->addColumn('image', $this->data())
            ->addColumn('image_201', $this->data())
            ->addColumn('image_extension', $this->string())
            ->addColumn('image_name', $this->string())
            ->addColumn('schema', $this->data())
            ->addColumn('schema_201', $this->data())
            ->addColumn('schema_extension', $this->string())
            ->addColumn('schema_name', $this->string());
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
