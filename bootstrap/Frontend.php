<?php
namespace execut\shops\bootstrap;
use yii\helpers\ArrayHelper;

class Frontend extends Common
{
    public function getDefaultDepends()
    {
        return ArrayHelper::merge(parent::getDefaultDepends(), [
            'modules' => [
                'shops' => [
                    'controllerNamespace' => 'execut\shops\frontend',
                ],
            ],
        ]);
    }
}