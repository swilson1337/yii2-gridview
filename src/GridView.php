<?php

namespace swilson1337\grid;

class GridView extends \kartik\grid\GridView
{
	public $pjax = true;
	
	public $layout = "{items}\n<div class=\"pull-left\">{summary}</div><div class=\"pull-right\">{pager}</div>";
	
	public $showFilters = true;
	
	public function init()
	{
		parent::init();
		
		if (!$this->showFilters)
		{
			$this->filterRowOptions['style'] = 'display: none;';
		}
	}
}