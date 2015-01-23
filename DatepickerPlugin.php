<?php
namespace bootui\datetimepicker;

use yii\web\AssetBundle;
/**
 * Bootstrap Asset Bundle
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class DatepickerPlugin extends AssetBundle
{
	public $sourcePath = '@bootui/datetimepicker/assets';
	
	public $css = [
		'css/bootstrap-datetimepicker.css',
	];
	
	public $js = [
		'js/moment.js',
		'js/bootstrap-datetimepicker.js',
	];
	
	public $depends = [
		'yii\web\JqueryAsset',
	];
}