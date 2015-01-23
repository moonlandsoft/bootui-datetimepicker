<?php
namespace bootui\datetimepicker;

class Datepicker extends BasePicker
{	
	public function init()
	{
		$this->pick['date'] = true;
		parent::init();
		if (!isset($this->clientOptions['format']))
			$this->clientOptions['format'] = "YYYY-MM-DD";
	}
}