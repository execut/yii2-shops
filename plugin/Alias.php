<?php
namespace execut\shops\plugin;
use execut\shops\models\Shop;

class Alias implements \execut\shops\Plugin
{
    public function getShopsFieldsPlugins()
    {
        return [
            'alias' => [
                'class' => \execut\alias\crudFields\Plugin::class,
            ],
        ];
    }

    public function getShopsListAttributes() {
        return ['alias'];
    }

    public function getShopUrl(Shop $shop) {
        return [
            '/shops/shops/view',
            'alias' => $shop->alias,
        ];
    }

    public function getNavigationPageByShopModel(Shop $model) {}

    public function getNavigationMainPage() {}
}