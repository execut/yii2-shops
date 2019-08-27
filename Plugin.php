<?php
namespace execut\shops;
use execut\shops\models\Shop;

interface Plugin
{
    public function getShopsFieldsPlugins();

    public function getShopsListAttributes();
    public function getShopUrl(Shop $shop);

    public function getNavigationPageByShopModel(Shop $model);
    public function getNavigationMainPage();
}