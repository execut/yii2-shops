<?php
namespace execut\shops\widgets;

use execut\navigation\widgets\Text;
use execut\yii\OnceWidget;
use yii\helpers\Html;
use execut\yii\jui\Widget;
use yii\helpers\Url;

class ShopView extends Widget
{
    public $model = null;
    public function run() {
        $this->_registerBundle();
        $shop = $this->model;
        echo '<div class="shop-page">
            <div class="row shop-info-wrapper">
                <div class="col-md-6 row">';
        if ($imageUrl = $shop->getImageUrl()) {
            echo '<a href="' . Url::to($shop->getImageUrl('image')) . '" rel="gallery" class="img fancybox col-md-6">'
                . Html::img(Url::to($imageUrl) . '', [
                    'title' => $shop->name,
                    'class' => 'img-border',
                ]);
            echo '</a>';
        }

        if ($imageUrl = $shop->getSchemaUrl()) {
            echo '<a href="' . Url::to($shop->getSchemaUrl('schema')) . '" rel="gallery" class="img fancybox col-md-6">'
                . Html::img(Url::to($imageUrl) . '', [
                    'title' => $shop->name,
                    'class' => 'img-border',
                ]);
            echo '</a>';
        }

        echo '</div>
        <div class="col-md-6 shop-info-ph">
            Режим работы:<br>';
        echo $shop->work_time;
        if (\yii::$app->getModule('shops')->isShowPhones) {
            echo '<span class="phone"><span><em>Тел.:</em> +7 (812)</span> ' . $shop->phone_1 . '</span>';
        }
        echo '</div>
        </div>';
        echo OnceWidget::widget([
            'widget' => [
                'class' => Text::class,
            ],
        ]);
        echo '</div>';
    }
}