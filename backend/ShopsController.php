<?php
namespace execut\shops\backend;

use execut\actions\Action;
use execut\actions\action\adapter\File;
use execut\crud\params\Crud;
use execut\shops\models\Shop;
use yii\filters\AccessControl;
use yii\web\Controller;

class ShopsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [$this->module->adminRole],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return \yii::createObject([
            'class' => Crud::class,
            'modelClass' => Shop::class,
            'module' => 'shop',
            'moduleName' => 'Shops',
            'modelName' => Shop::MODEL_NAME,
        ])->actions([
            'update' => [
                'adapter' => [
                    'filesAttributes' => [
                        'image' => 'imageFile',
                        'schema' => 'schemaFile',
                    ],
                ],
            ],
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
        ]);
    }
}