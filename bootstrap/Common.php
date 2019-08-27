<?php
namespace execut\shops\bootstrap;

use execut\yii\Bootstrap;
use execut\shops\Module;
use yii\base\Application;

class Common extends Bootstrap
{
    protected $isBootstrapI18n = true;
    public function getDefaultDepends()
    {
        return [
            'modules' => [
                'shops' => [
                    'class' => Module::class
                ],
            ],
        ];
    }

    public function bootstrap($app)
    {
        parent::bootstrap($app);
        $this->initNavigation($app);
    }

    /**
     * @param Application $app
     */
    public function initNavigation($app)
    {
    }
}