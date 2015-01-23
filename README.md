Bootstrap Date Time Picker
==========================
Bootstrap Datepicker and Timepicker in one extentions

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist moonlandsoft/bootui-datetimepicker "*"
```

or add

```
"moonlandsoft/bootui-datetimepicker": "*"
```

to the require section of your `composer.json` file.

Properties
----------
## addon
Addon is a bootstrap input group addon, you can see [bootstrap input group](http://getbootstrap.com/components#input-groups) to details of documentation. Extend form controls by adding text or buttons before, after, or on both sides of any text-based input.

## format
You can change format of date or time using this property but this format only use [momentjs date time format](http://momentjs.com/) and not use php date time format. Click [here](http://momentjs.com/docs/#/displaying/format/) to see all of datetime format.

## others properties
For others properties you can see in [bootstrap-datetimepicker](http://eonasdan.github.io/bootstrap-datetimepicker/Options/). You can directly add the property from bootstrap-datetimepicker and my widget will instantly recognize the property.

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \bootui\datetimepicker\Datepicker::widget([
 	'name' => 'date',
 	'options' => ['class' => 'form-control'],
 	'addon' => ['prepend' => 'Birth Date'],
 	'format' => 'YYYY-MM-DD',
]); ?>

<?= \bootui\datetimepicker\Timepicker::widget([ 
	'name' => 'time',
 	'options' => ['class' => 'form-control'],
 	'addon' => ['prepend' => 'Time'],
 	'format' => 'HH:mm',
]); ?>

<?= \bootui\datetimepicker\DateTimepicker::widget([
 	'name' => 'datetime',
 	'options' => ['class' => 'form-control'],
 	'addon' => ['prepend' => 'Date and Time'],
 	'format' => 'YYYY-MM-DD HH:mm',
]); ?>
```

or

```php
<?= $form->field($model, 'attribute')->widget(Datepicker::className(),[
 	'options' => ['class' => 'form-control'],
 	'addon' => ['prepend' => 'Birth Date'],
 	'format' => 'YYYY-MM-DD',
]); ?>

<?= $form->field($model, 'attribute')->widget(Timepicker::className(),[ 
 	'options' => ['class' => 'form-control'],
 	'addon' => ['prepend' => 'Time'],
 	'format' => 'HH:mm',
]); ?>

<?= $form->field($model, 'attribute')->widget(DateTimepicker::className(),[
 	'options' => ['class' => 'form-control'],
 	'addon' => ['prepend' => 'Date and Time'],
 	'format' => 'YYYY-MM-DD HH:mm',
]); ?>
```