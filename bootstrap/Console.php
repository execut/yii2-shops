<?php
namespace execut\shops\bootstrap;


use yii\helpers\ArrayHelper;

class Console extends Common
{
    public function getDefaultDepends()
    {
        return ArrayHelper::merge(parent::getDefaultDepends(), [
            'modules' => [
                'shops' => [
                    'controllerNamespace' => 'execut\shops\console',
                ],
            ],
        ]);
    }
}