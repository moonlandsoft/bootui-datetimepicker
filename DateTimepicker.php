<?php
namespace bootui\datetimepicker;

class DateTimepicker extends BasePicker
{	
	public function init()
	{
		$this->pick['date'] = true;
		$this->pick['time'] = true;
		parent::init();
		if (!isset($this->clientOptions['format']))
			$this->clientOptions['format'] = "YYYY-MM-DD H:i";
	}
}
