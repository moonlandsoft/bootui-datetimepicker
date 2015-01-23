<?php
namespace bootui\datetimepicker;

use yii\helpers\Html;
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