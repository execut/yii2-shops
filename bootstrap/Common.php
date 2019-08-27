<?php
namespace execut\shops\bootstrap;

use execut\yii\Bootstrap;
use execut\shops\Module;
use yii\base\Application;

class Common extends Bootstrap
{
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
        $this->registerTranslations($app);
    }

    public function registerTranslations($app) {
        $app->i18n->translations['execut/shops'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/execut/shops/messages',
            'fileMap' => [
                'execut/shops' => 'shops.php',
            ],
        ];
    }

    /**
     * @param Application $app
     */
    public function initNavigation($app)
    {
    }
}