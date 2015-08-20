Yii2 Ueditor
==============

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist macle/yii2-ueditor "*"
```

or add

```
"macle/yii2-ueditor": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php
use macle\ueditor\Ueditor;

echo Ueditor::widget(['id'=>"newstext"]); 

?>
```