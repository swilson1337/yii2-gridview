<?php

namespace swilson1337\grid;

use yii\helpers\ArrayHelper;

class GridView extends \kartik\grid\GridView
{
	public $pjax = true;
	
	public $showFilters = true;
	
	private $defaultPanelOptions = [
		'type' => GridView::TYPE_DEFAULT,
		'after' => '{summary}',
		'heading' => false,
	];
	
	private $defaultExportOptions = [
		'label' => 'Export Data To File',
		'target' => '_self',
	];
	
	public function init()
	{
		parent::init();
		
		$this->export = ArrayHelper::merge($this->defaultExportOptions, (is_array($this->export) ? $this->export : []));
		
		$this->panel = ArrayHelper::merge($this->defaultPanelOptions, (is_array($this->panel) ? $this->panel : []));
		
		if (!$this->showFilters)
		{
			$this->filterRowOptions['style'] = 'display: none;';
		}
	}
}
