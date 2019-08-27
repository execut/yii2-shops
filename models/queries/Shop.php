<?php
namespace execut\shops\models\queries;


use yii\db\ActiveQuery;

class Shop extends ActiveQuery
{
    public function isVisible() {
        $class = $this->modelClass;

        return $this->andWhere($class::tableName() . '.visible');
    }

    public function orderBySort() {
        return $this->addOrderBy('sort DESC');
    }

    public function isForList() {
        return $this->orderBySort()->isVisible()
            ->select(array_merge(['id', 'name', 'phone_1', 'address', 'image_extension', 'image_md5', 'work_time'], \yii::$app->getModule('shops')->getShopsListAttributes()));
    }

    public function isForMap() {
        return $this->select(['id', 'name', 'phone_1', 'phone_2', 'address', 'work_time', 'specialization', 'text_header_map', 'coords']);
    }
}