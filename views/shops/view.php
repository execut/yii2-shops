<?php
echo \execut\shops\widgets\MapWidget::widget([
    'idOpen' => $model->id,
]);
echo \execut\shops\widgets\ShopView::widget([
    'model' => $model,
]);