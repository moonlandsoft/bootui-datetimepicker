Bootstrap Date Time Picker
==========================
Bootstrap Datepicker and Timepicker in one extentions

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist 3ch3r46/bootui-datetimepicker "*"
```

or add

```
"3ch3r46/bootui-datetimepicker": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \bootui\datetimepicker\Datepicker::widget(); ?>

<?= \bootui\datetimepicker\Timepicker::widget(); ?>
```

or

```php
<?= $form->field($model, 'attribute')->widget(Datepicker::className()); ?>

<?= $form->field($model, 'attribute')->widget(Timepicker::className()); ?>
```