# yii2-shops
Yii2 module for controlling static shops via CRUD. The module can used both separately and as part
of the [execut/yii2-cms](https://github.com/execut/yii2-cms).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

### Install

Either run

```
$ php composer.phar require execut/yii2-shops
```

or add

```
"execut/yii2-shops": "@dev"
```

to the ```require``` section of your `composer.json` file.

### Configuration

Add module bootstrap to backend application config:
```php
    'bootstrap' => [
    ...
        'shops' => [
            'class' => \execut\shops\bootstrap\Backend::class,
        ],
    ...
    ],
```

Add module bootstrap to common application config:
```php
    'bootstrap' => [
    ...
        'shops' => [
            'class' => \execut\shops\bootstrap\Common::class,
        ],
    ...
    ],
```

Add module bootstrap inside console application config:
```php
    'bootstrap' => [
    ...
        'shops' => [
            'class' => \execut\shops\bootstrap\Console::class,
        ],
    ...
    ],
```

Apply migrations via yii command:
```
./yii migrate/up --interactive=0
```

After configuration, the module should open by paths:
shops/backend

### Module backend navigation

You may output navigation of module inside your layout via execut/yii2-navigation:
```php
    echo Nav::widget([
        ...
        'items' => \yii\helpers\ArrayHelper::merge($menuItems, \yii::$app->navigation->getMenuItems()),
        ...
    ]);
    NavBar::end();

    // Before standard breadcrumbs render breadcrumbs and header widget:
echo \execut\navigation\widgets\Breadcrumbs::widget();
echo \execut\navigation\widgets\Header::widget();
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
```
For more information about execut/yii2-navigation module, please read it [documentation](https://github.com/execut/yii2-navigation)

### Usage
#### Administration


Section contains the following columns:

Name|Description
----|-----------

On frontend page is available by parameter ?id=# on main page or /shops/shops?id=#, where # - database page identify

#### Increasing functionality

The module has poor functionality. For adding more functionality inside module you can connect to module plugin or create it. Plugins based on interface execut\shops\Plugin


Already available plugins sorted by priority:

Name|Required module|Functionality
----|---------------|-------------
Alias|[execut/yii2-alias](http://github.com/execut/yii2-alias)|Attach to every page own alias for adding humanize urls
Seo|[execut/yii2-seo](http://github.com/execut/yii2-seo)|Editor and seo metaTags inside backend. Rendering text and metaTags on frontend.

After selecting the necessary plugins, connect them as follows to module via common bootstrap depends config:
```php
    'bootstrap' => [
    ...
        'shops' => [
            'class' => \execut\shops\bootstrap\Common::class,
            'depends' => [
                'modules' => [
                    'settings' => [
                        'plugins' => [
                            'own-plugin' => [
                                'class' => $pluginClass // You plugin class here
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ...
    ],
```
