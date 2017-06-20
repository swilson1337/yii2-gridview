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
	
	private static $defaultPagerOptions = [
		'firstPageLabel' => 'First',
		'lastPageLabel' => 'Last',
	];
	
	public $panelFooterTemplate = '<div class="pull-left kv-panel-pager">{pager}</div>{footer}<div class="clearfix"></div>';
	
	public $toggleData = true;
	
	public $toggleDataOptions = [
		'all' => [
			'icon' => 'resize-full',
			'label' => 'Show All Items',
			'class' => 'btn btn-default',
			'title' => 'Show All Items',
		],
		'page' => [
			'icon' => 'resize-small',
			'label' => 'Show Paged Items',
			'class' => 'btn btn-default',
			'title' => 'Show Paged Items',
		],
	];
	
	public $pjax = true;
	
	public $showFilters = true;
	
	public $responsiveWrap = false;
	
	public $perfectScrollbar = true;
	
	public $panelHeadingTemplate = '{heading}<div class="pull-right">{toolbar}</div><div class="clearfix"></div>';
	
	public $dataColumnClass = 'swilson1337\grid\DataColumn';
	
	public $panelBeforeTemplate = '{before}<div class="clearfix"></div>';
	
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
		
		if (is_array($this->pager))
		{
			$this->pager = ArrayHelper::merge(static::$defaultPagerOptions, $this->pager);
		}
		
		Html::addCssStyle($this->filterRowOptions, 'display: none;');
		
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
			
			$this->view->registerJs('$("#'.$this->id.'-pjax").on("pjax:complete", function() { if (sessionStorage.getItem("'.$this->id.'-toggle-toolbar") === "true") { $("#'.$this->id.' .filters").show(0); } else { $("#'.$this->id.' .filters").hide(0); } });');
		}
		
		if ($this->toggleData && $this->dataProvider->totalCount > 1000)
		{
			$this->toggleData = false;
		}
		
		parent::init();
	}
}
