<?php

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m180918_140354_newColumn extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('shops_shops')
            ->addColumn('short_address', $this->string())
            ->update([
                'short_address' => '-',
            ])
            ->alterColumnSetNotNull('short_address');
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
