<?php
namespace bootui\datetimepicker;

/**
 * DateTimepicker widgets
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
