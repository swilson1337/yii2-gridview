<?php

namespace swilson1337\grid;

use yii\helpers\ArrayHelper;

class GridView extends \kartik\grid\GridView
{
	private static $defaultPanelOptions = [
		'type' => GridView::TYPE_DEFAULT,
		'after' => false,
		'heading' => false,
		'footer' => '<div class="pull-right">{summary}</div>',
	];
	
	private static $defaultExportOptions = [
		'label' => 'Export Data To File',
		'target' => '_self',
	];
	
	public $panelFooterTemplate = '<div class="pull-left kv-panel-pager">{pager}</div>{footer}<div class="clearfix"></div>';
	
	public $panelTemplate = '<div class="{prefix}{type}">{panelHeading}{panelBefore}<div class="panel-body">{items}</div>{panelAfter}{panelFooter}</div>';
	
	public $toggleData = false;
	
	public $pjax = true;
	
	public $showFilters = true;
	
	public function init()
	{
		if (is_array($this->export))
		{
			$this->export = ArrayHelper::merge(static::$defaultExportOptions, $this->export);
		}
		
		if (is_array($this->panel))
		{
			$this->panel = ArrayHelper::merge(static::$defaultPanelOptions, $this->panel);
		}
		
		if (!$this->showFilters)
		{
			$this->filterRowOptions['style'] = 'display: none;';
		}
		
		parent::init();
	}
}
