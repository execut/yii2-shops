<?php
namespace execut\shops\frontend;

use execut\actions\Action;
use execut\actions\action\adapter\File;
use execut\shops\models\Shop;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ShopsController extends Controller
{
    public function actions()
    {
        return [
            'schema' => [
                'class' => Action::class,
                'adapter' => [
                    'class' => File::class,
                    'modelClass' => Shop::class,
                    'dataAttribute' => 'schema',
                    'nameAttribute' => 'schema_name',
                    'mimeTypeAttribute' => false,
                    'extensionAttribute' => 'schema_extension'
                ],
            ],
            'image' => [
                'class' => Action::class,
                'adapter' => [
                    'class' => File::class,
                    'modelClass' => Shop::class,
                    'dataAttribute' => 'image',
                    'nameAttribute' => 'image_name',
                    'mimeTypeAttribute' => false,
                    'extensionAttribute' => 'image_extension'
                ],
            ],
        ];
    }

    public function actionIndex() {
        $this->addMainPage();

        $dataProvider = new ActiveDataProvider([
            'query' => Shop::find()->isForList(),
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        $model = Shop::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException(\yii::t('execut/shops', 'Shop not found'));
        }

        $this->addMainPage();
        \yii::$app->navigation->addPage($this->module->getNavigationPageByShopModel($model));

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function addMainPage(): void
    {
        \yii::$app->navigation->addPage($this->module->getNavigationMainPage());
    }
}