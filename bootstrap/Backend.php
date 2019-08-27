<?php
namespace execut\shops\bootstrap;

use execut\crud\navigation\Configurator;
use execut\shops\models\Shop;
use yii\helpers\ArrayHelper;

class Backend extends Common
{
    public function getDefaultDepends()
    {
        return ArrayHelper::merge(parent::getDefaultDepends(), [
            'modules' => [
                'shops' => [
                    'controllerNamespace' => 'execut\shops\backend',
                ],
            ],
        ]);
    }

    public function initNavigation($app)
    {
        parent::initNavigation($app);
        $module = \yii::$app->getModule('shops');
        if (!$app->user->can($module->adminRole)) {
            return;
        }
        $app->navigation->addConfigurator([
            'class' => Configurator::class,
            'module' => 'shops',
            'moduleName' => 'Shops',
            'modelName' => Shop::MODEL_NAME,
            'controller' => 'shops',
        ]);
    }
}