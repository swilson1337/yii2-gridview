<?php

namespace swilson1337\grid;

class GridView extends \kartik\grid\GridView
{
	public $pjax = true;
	
	public $layout = "<div class=\"row\"><div class=\"col-sm-12\"><div class=\"pull-right\">{export}</div></div></div><br /><div class=\"row\"><div class=\"col-sm-12\">{items}</div></div><div class=\"row\"><div class=\"col-sm-6\">{summary}</div><div class=\"col-sm-6\"><div class=\"pull-right\">{pager}</div></div></div>";
	
	public $showFilters = true;
	
	public $export = [
		'label' => 'Export',
		'target' => '_self',
		'showConfirmAlert' => false,
	];
	
	public function init()
	{
		parent::init();
		
		if (!$this->showFilters)
		{
			$this->filterRowOptions['style'] = 'display: none;';
		}
	}
}
