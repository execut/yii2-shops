<?php
namespace execut\shops\plugin;

use execut\seo\navigation\Page;
use execut\shops\models\Shop;
class Seo implements \execut\shops\Plugin
{
    public function getShopsFieldsPlugins()
    {
        return [
            'seo' => [
                'class' => \execut\seo\crudFields\Fields::class
            ],
        ];
    }

    public function getNavigationPageByShopModel(Shop $model) {
        return new Page([
            'route' => '/shops/shops/view',
            'model' => $model,
        ]);
    }

    public function getShopsListAttributes() {}

    public function getShopUrl(Shop $shop) {}

    public function getNavigationMainPage() {}
}