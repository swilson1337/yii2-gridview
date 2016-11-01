<?php

namespace swilson1337\grid;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class GridView extends \kartik\grid\GridView
{
	private static $defaultPanelOptions = [
		'type' => GridView::TYPE_DEFAULT,
		'after' => false,
		'footer' => '<div class="pull-right">{summary}</div>',
		'before' => false,
	];
	
	private static $defaultExportOptions = [
		'label' => 'Export Data To File',
		'target' => '_self',
	];
	
	public $panelFooterTemplate = '<div class="pull-left kv-panel-pager">{pager}</div>{footer}<div class="clearfix"></div>';
	
	public $toggleData = false;
	
	public $pjax = true;
	
	public $showFilters = true;
	
	public $hover = true;
	
	public $condensed = true;
	
	public $panelHeadingTemplate = '{heading}<div class="pull-right">{toolbar}</div><div class="clearfix"></div>';
	
	public $dataColumnClass = 'swilson1337\grid\DataColumn';
	
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
		
		if ($this->showFilters && $this->filterModel !== null && count($this->filterModel->attributes) > 0)
		{
			if (!is_array($this->toolbar))
			{
				if (!empty($this->toolbar))
				{
					$this->toolbar = [
						'content' => $this->toolbar,
					];
				}
				else
				{
					$this->toolbar = [];
				}
			}
			
			array_unshift($this->toolbar, [
				'content' => Html::button('<span class="glyphicon glyphicon-zoom-in"></span> Toggle Filters', [
					'class' => 'btn btn-default',
					'onClick' => 'sessionStorage.setItem("'.$this->id.'-toggle-toolbar", !$("#'.$this->id.' .filters").is(":visible")); $("#'.$this->id.' .filters").toggle(0);',
				]),
			]);
			
			$this->view->registerJs('if (sessionStorage.getItem("'.$this->id.'-toggle-toolbar") === "true") { $("#'.$this->id.' .filters").show(0); } else { $("#'.$this->id.' .filters").hide(0); }');
		}
		else
		{
			Html::addCssStyle($this->filterRowOptions, 'display: none;');
		}
		
		parent::init();
	}
}
