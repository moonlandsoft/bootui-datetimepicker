<?php
namespace bootui\datetimepicker;

/**
 * DateTimepicker widgets
 * 
 * 
 * ~~~
 * [php]
 * <?php
 * 
 * 
 * echo DateTimepicker::widget([
 * 	'name' => 'datetime',
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Date and Time'],
 * 	'format' => 'YYYY-MM-DD HH:mm',
 * ]);
 * 
 * echo $form->field($model, 'attribute')->widget(Timepicker::className(), [ 
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Date and Time'],
 * 	'format' => 'YYYY-MM-DD HH:mm',
 * ]);
 * ~~~
 * 
 * 
 * @author Moh Khoirul Anam <moh.khoirul.anaam@gmail.com>
 * @copyright moonlandsoft 2015
 * @since 1
 *
 */
class DateTimepicker extends BasePicker
{	
	public function init()
	{
		$this->pick['date'] = true;
		$this->pick['time'] = true;
		parent::init();
		if (!isset($this->clientOptions['format']))
			$this->clientOptions['format'] = "YYYY-MM-DD HH:mm";
	}
}
