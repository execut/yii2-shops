<?php
namespace execut\shops\widgets;
use yii\helpers\Html;
use execut\yii\jui\Widget;
use yii\helpers\Url;

class ShopsList extends Widget
{
    public $dataProvider = null;
    public function run() {
        $this->_registerBundle();
        echo '<div class="row shops-list">';
        $dataProvider = $this->dataProvider;
        foreach ($dataProvider->models AS $shop) {
            $url = Url::to([
                '/shops/shops/view',
                'id' => $shop->id,
            ]);
            echo '<div class="col-md-6 shop-item shop-item-odd">
                <div class="row">
                    <div class="col-md-5">
                        <a href="' . $url . '">';
            if ($img = $shop->getImageUrl()) {
                echo Html::img(Url::to($img), [
                    'title' => $shop->name,
                    'class' => 'img-border',
                ]);
            }

            echo '</a>
                    </div>
                    <div class="col-md-7 shop-item-content">
                        <div class="shop-item-logos">';
            echo '</div>
                        <a href="' . $url . '">' . $shop->address . '</a>
                        <span class="shop-item-mode">Режим работы: ' . $shop->work_time . '</span>
                        Тел.: +7 (812) <span class="shop-item-phone">' . $shop->phone_1 . '</span>
                    </div>
                </div>
            </div>';
        }

        echo '</div>';
    }
}