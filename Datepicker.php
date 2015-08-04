<?php
namespace bootui\datetimepicker;

/**
 * Datepicker widgets
 * 
 * ~~~
 * [php]
 * <?php
 * 
 * 
 * echo Datepicker::widget([
 * 	'name' => 'date',
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Birth Date'],
 * 	'format' => 'YYYY-MM-DD',
 * ]);
 * 
 * echo $form->field($model, 'attribute')->widget(Datepicker::className(), [ 
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Birth Date'],
 * 	'format' => 'YYYY-MM-DD',
 * ]);
 * ~~~
 * 
 * 
 * @author Moh Khoirul Anam <moh.khoirul.anaam@gmail.com>
 * @copyright moonlandsoft 2015
 * @since 1
 *
 */
class Datepicker extends BasePicker
{	
	public function init()
	{
		parent::init();
		if (!isset($this->clientOptions['format']))
			$this->clientOptions['format'] = "YYYY-MM-DD";
	}
}