<?php
namespace bootui\datetimepicker;

/**
 * Datepicker widgets
 * @author Moh Khoirul Anam <moh.khoirul.anaam@gmail.com>
 * @copyright moonlandsoft 2015
 * @since 1
 *
 */
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