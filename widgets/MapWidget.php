<?php
namespace execut\shops\widgets;
use execut\shops\models\Shop;
use execut\yii\jui\Widget;
class MapWidget extends Widget
{
    public $idOpen = 0;
    public $isOpenFirst = false;
    public $centerCoords = [59.940485, 30.312306];
    public $isInitAfterLoad = true;

    public function run()
    {
        $shops = Shop::find()->isForMap()->isVisible()->addOrderBy('sort ASC')->all();
        $shops_arr = array();

        $i = 0;
        $openedBaloon = -1;
        foreach ($shops AS $shop) {
            if (!empty($shop->coords)) {
                if ($shop->id == $this->idOpen) {
                    $openedBaloon = $i;
                }

                $shops_arr[$i]['coords'] = $shop->coords;
                $shops_arr[$i]['hintContent'] = $shop->name;
                $count_info = 0;
                $contBody = '';
                if (\yii::$app->getModule('shops')->isShowPhones) {
                    if (!empty($shop->phone_1) || !empty($shop->phone_2)) {
                        $contBody = 'Тел.: ';
                        if (!empty($shop->phone_1)) {
                            $contBody .= $shop->phone_1;
                            $count_info++;
                        }
                        if (!empty($shop->phone_2)) {
                            if ($count_info > 0) $contBody .= ', ';
                            $contBody .= $shop->phone_2;
                            $count_info++;
                        }
                    }
                }
                if (!empty($shop->work_time)) {
                    if ($count_info > 0) $contBody .= '<br>';
                    $contBody .= $shop->work_time;
                    $count_info = 1;
                }
                if (!empty($shop->specialization)) {
                    if ($count_info > 0) $contBody .= '<br>';
                    $contBody .= 'Специализация: ' . $shop->specialization;
                }

                $shops_arr[$i]['balloonContentBody'] = $contBody;
                if (!empty($shop->text_header_map))
                    $shops_arr[$i]['balloonContentHeader'] = $shop->text_header_map;
                $i++;
            }
        }

        $this->clientOptions = [
            'shops' => $shops_arr,
            'coords' => $this->centerCoords,
            'openedBaloon' => $openedBaloon,
            'isInitAfterLoad' => $this->isInitAfterLoad,
        ];

        $this->_registerBundle();
        $this->registerWidget();
        $result = $this->_renderContainer('<div class="map-image"></div>');

        return $result;
    }
}
