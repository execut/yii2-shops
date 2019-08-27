<?php
namespace execut\shops;
use execut\dependencies\PluginBehavior;
use execut\navigation\Page;
use execut\shops\models\Shop;

/**
 * Class Module
 * @package execut\shops
 * @mixin PluginBehavior
 */
class Module extends \yii\base\Module implements Plugin
{
    public $adminRole = '@';
    public function behaviors()
    {
        return [
            'dependencies' => [
                'class' => PluginBehavior::class,
                'pluginInterface' => Plugin::class,
            ],
        ];
    }

    public function getShopsFieldsPlugins() {
        $result = $this->getPluginsResults(__FUNCTION__);
        if ($result === null) {
            $result = [];
        }

        return $result;
    }

    public function getShopsListAttributes() {
        $result = $this->getPluginsResults(__FUNCTION__);
        if (!$result) {
            return [];
        }

        return $result;
    }

    public function getShopUrl(Shop $shop) {
        $result = $this->getPluginsResults(__FUNCTION__, true, func_get_args());
        if (!$result) {
            return [
                '/shops/shops/view',
                'id' => $shop->id,
            ];
        }

        return $result;
    }

    public function getNavigationPageByShopModel(Shop $model) {
        $result = $this->getPluginsResults(__FUNCTION__, true, func_get_args());
        if (!$result) {
            $result = new Page([
                'name' => $model->name,
            ]);
        }

        return $result;
    }

    public function getNavigationMainPage() {
        $result = $this->getPluginsResults(__FUNCTION__, true, func_get_args());
        if (!$result) {
            $result = new Page([
                'name' => \yii::t('execut/shops', 'Shops'),
                'url' => [
                    '/shops/shops/index',
                ],
            ]);
        }

        return $result;
    }
}