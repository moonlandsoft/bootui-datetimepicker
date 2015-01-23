<?php
namespace bootui\datetimepicker;

use yii\helpers\Html;

/**
 * Timepicker widgets
 * 
 * ~~~
 * [php]
 * <?php
 * 
 * 
 * echo Timepicker::widget([
 * 	'name' => 'time',
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Time'],
 * 	'format' => 'HH:mm',
 * ]);
 * 
 * echo $form->field($model, 'attribute')->widget(Timepicker::className(), [ 
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Time'],
 * 	'format' => 'HH:mm',
 * ]);
 * ~~~
 * 
 * @author Moh Khoirul Anam <moh.khoirul.anaam@gmail.com>
 * @copyright moonlandsoft 2015
 * @since 1
 *
 */
class Timepicker extends BasePicker
{
	public function init()
	{
		$this->pick['time'] = true;
		parent::init();
		if (!isset($this->clientOptions['format']))
			$this->clientOptions['format'] = "HH:mm";
	}
}