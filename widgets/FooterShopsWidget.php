<?php
namespace execut\shops\widgets;

use execut\shops\models\Shop;
use yii\helpers\Html;

class FooterShopsWidget extends \execut\yii\jui\Widget
{
    public $htmlOptions = [];
    public function run() {
        $shops = Shop::find()->isForList()->all();
        echo "<h3>Адреса магазинов</h3>";
        echo Html::beginTag('ul', $this->htmlOptions)."\n";
        foreach ($shops AS $shop) {
            $url = \yii::$app->getModule('shops')->getShopUrl($shop);
            echo '<li class="footer-address-item">';
            echo '<div class="sprite-icon sprite-icon-logo-icon"></div>';
            echo Html::a($shop->address, $url);
            if (\yii::$app->getModule('shops')->isShowPhones) {
                echo '<br><span class="footer-address-phone">Тел.: (812) ' . $shop->phone_1 . '</span>';
            }

            echo '</li>';
        }

        echo Html::endTag('ul');
    }
}