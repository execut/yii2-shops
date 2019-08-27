<?php
echo \execut\shops\widgets\MapWidget::widget();
echo \execut\shops\widgets\ShopsList::widget([
    'dataProvider' => $dataProvider,
]);