<?php
namespace bootui\datetimepicker;

use yii\widgets\InputWidget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * BasePicker widgets
 * @author Moh Khoirul Anam <moh.khoirul.anaam@gmail.com>
 * @copyright moonlandsoft 2015
 * @since 1
 *
 */
class BasePicker extends InputWidget
{
	// SIZE Input
	const SIZE_LARGE = 'lg';
	const SIZE_SMALL = 'sm';
	
	// Datepicker Type
	const TYPE_RANGE = 'range';
	const TYPE_EMBEDDED = 'embedded';
	const TYPE_COMP_LEFT = 'comp_left';
	const TYPE_COMP_RIGHT = 'comp_right';
	
	// Datepicker Min View Mode
	const VIEW_DAYS = 0;
	const VIEW_MONTHS = 1;
	const VIEW_YEARS = 2;
	
	// Datepicker Start View
	const START_MONTH = 0;
	const START_YEAR = 1;
	const START_DECADE = 2;
	
	public $pick = ['date' => false, 'time' => false];
	
	/**
	 * @var string type datepicker
	 */
	public $type;
	
	/**
	 * @var string datepicker size
	 */
	public $size;
	
	/**
	 * @var array bootstrap addon :
	 * - append
	 * - prepend
	 */
	public $addon = [];
	
	protected $hasGroup = false;
	
	/**
	 * @var string sparator in range
	 */
	public $sparator = 'to';
	
	public $groupOptions = [
		'class' => 'input-group',
	];
	
	/**
	 * @var array config datepicker
	 */
	protected $clientOptions = [
		'useCurrent' => false,
		'autoclose' => true,
		'todayHighlight' => true,
	];
	
	public function __set($name, $value)
	{
		if (isset($this->{$name}))
			parent::__set($name, $value);
		else
			$this->clientOptions[$name] = $value;
	}
	
	public function init()
	{
		if (!empty($this->addon))
			$this->hasGroup = true;

		if (!$this->hasModel() && $this->name === null) {
			throw new InvalidConfigException("Either 'name', or 'model' and 'attribute' properties must be specified.");
		}
		
		if (isset($this->type) && $this->type == static::TYPE_RANGE) {
			$this->groupOptions['id'] = $this->type . '-' . $this->getId();
			Html::addCssClass($this->groupOptions, 'input-daterange');
			Html::addCssClass($this->options[0], 'form-control');
			Html::addCssClass($this->options[1], 'form-control');
		} else {
			if (!isset($this->options['id'])) {
				$this->options['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
			}
			if (isset($this->type) && ($this->type == static::TYPE_COMP_LEFT || $this->type == static::TYPE_COMP_RIGHT)) {
				Html::addCssClass($this->groupOptions, 'date');
				$this->groupOptions['id'] = $this->type . '-' . $this->options['id'] . '-' . $this->getId();
			}
			Html::addCssClass($this->options, 'form-control');
		}
	}
	
	public function run()
	{
		// To set pick the date or time
		foreach ($this->pick as $option=>$value) {
			$this->clientOptions['pick' . ucfirst($option)] = $value;
		}
		if ($this->type == self::TYPE_RANGE) {
			$this->registerPlugin($this->groupOptions['id'] . '.input-daterange');
		} elseif ($this->type == self::TYPE_COMP_LEFT || $this->type == self::TYPE_COMP_RIGHT) {
			$this->registerPlugin($this->groupOptions['id'] . '.date');
		} else
			$this->registerPlugin($this->options['id']);
		return $this->renderInput();
	}
	
	protected function renderInput()
	{
		if (isset($this->size) && in_array($this->size, ['sm','lg']))
		{
			Html::addCssClass($this->options, 'input-' . $this->size);
			Html::addCssClass($this->groupOptions, 'input-group-' . $this->size);
		}
		
		if (isset($this->type) && $this->type == static::TYPE_RANGE) {
			$this->hasGroup = true;
			
			$input[] = $this->hasModel() ? 
				Html::activeTextInput($this->model, $this->attribute[0], $this->options[0]) : 
				Html::textInput($this->name[0], isset($this->value[0]) ? $this->value[0] : null, $this->options[0]);
			$input[] = Html::tag('span', $this->sparator, ['class' => 'input-group-addon']);
			$input[] = $this->hasModel() ? 
				Html::activeTextInput($this->model, $this->attribute[1], $this->options[1]) :
				Html::textInput($this->name[1], isset($this->value[1]) ? $this->value[1] : null, $this->options[1]);
			
			$input = implode('', $input);
		}
		elseif (isset($this->type) && ($this->type == static::TYPE_COMP_LEFT || $this->type == static::TYPE_COMP_RIGHT)) {
			$this->hasGroup = true;
			if ($this->type == static::TYPE_COMP_LEFT)
				$input[] = Html::tag('span', '<i class="glyphicon glyphicon-calendar"></i>', ['class' => 'input-group-addon']);
			
			$input[] = $this->hasModel() ? 
				Html::activeTextInput($this->model, $this->attribute, $this->options) : 
				Html::textInput($this->name, $this->value, $this->options);
			
			if ($this->type == static::TYPE_COMP_RIGHT)
				$input[] = Html::tag('span', '<i class="glyphicon glyphicon-calendar"></i>', ['class' => 'input-group-addon']);
			$input = implode('', $input);
		} 
		else {
			$input = $this->hasModel() ? 
				Html::activeTextInput($this->model, $this->attribute, $this->options) : 
				Html::textInput($this->name, $this->value, $this->options);
		}
		
		if ($this->hasGroup)
			$input = Html::tag('div', $this->prepareAddon($input), $this->groupOptions);
		
		return $input;
	}
	
	protected function prepareAddon($input)
	{
		extract($this->addon);
		
		$template = "{prepend}\n{input}\n{append}";
		$appendContent = [];
		$prependContent = [];
		
		if (isset($append)) {
			if (is_array($append)) {
				if (is_string($append[0]) && is_bool($append[1])) {
					if ($append[1] == true)
						$appendContent[] = Html::tag('span', $append[0], ['class' => 'input-group-btn']);
				} else {
					foreach ($append as $content) {
						$appendContent[] = $this->prepareContent($content);
					}
				}
			} else {
				$appendContent[] = Html::tag('span', $append, ['class' => 'input-group-addon']);
			}
		}
		if (isset($prepend)) {
			if (is_array($prepend)) {
				if (is_string($prepend[0]) && is_bool($prepend[1])) {
					if ($prepend[1] == true)
						$prependContent[] = Html::tag('span', $prepend[0], ['class' => 'input-group-btn']);
				} else {
					foreach ($prepend as $content) {
						$prependContent[] = $this->prepareContent($content);
					}
				}
			} else {
				$prependContent[] = Html::tag('span', $prepend, ['class' => 'input-group-addon']);
			}
		}
		
		return strtr($template, [
				'{prepend}' => implode('', $prependContent),
				'{input}' => $input,
				'{append}' => implode('', $appendContent),
		]);
	}
	
	protected function prepareContent($content)
	{
		if (is_array($content)) {
			if (!isset($content['class']) && isset($content[0]))
				$content['class'] = ArrayHelper::remove($content, 0);
			if (!isset($content['options']) && isset($content[1])) {
				if (is_bool($content[1]))
					$content['asButton'] = ArrayHelper::remove($content, 1);
				else
					$content['options'] = ArrayHelper::remove($content, 1);
			}
			if (!isset($content['asButton']))
				$content['asButton'] = ArrayHelper::remove($content, 2, false);
			$class = $content['class'];
			$options = isset($content['options']) ? $content['options'] : [];
			$asButton = $content['asButton'];
			
			if ($asButton)
				Html::addCssClass($tagOptions, 'input-group-btn');
			else 
				Html::addCssClass($tagOptions, 'input-group-addon');
			
			if (class_exists($class)) {
				$inContent = $class::widget($options);
			} else {
				$inContent = $class;
			}
			
			$content = Html::tag('span', $inContent, $tagOptions);
		} else {
			if ($content instanceof Widget)
				Html::addCssClass($tagOptions, 'input-group-btn');
			else
				Html::addCssClass($tagOptions, 'input-group-addon');
			$content = Html::tag('span', $content, $tagOptions);
		}
		return $content;
	}
	
	protected function registerPlugin($selector)
	{
		$view = $this->getView();
		
		DatepickerPlugin::register($view);
		
		$options = JSON::encode($this->clientOptions);
		
		$js = "jQuery('#$selector').datetimepicker({$options});";
		
		$view->registerJs($js);
	}
}