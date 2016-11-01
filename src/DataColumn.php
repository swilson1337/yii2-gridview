<?php

namespace swilson1337\grid;

class DataColumn extends \kartik\grid\DataColumn
{
	public $showFilter = true;
	
	public function init()
	{
		if (!$this->showFilter)
		{
			$this->filterInputOptions['style'] = 'display: none;';
		}
		
		parent::init();
	}
}