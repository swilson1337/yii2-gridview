<?php

namespace swilson1337\grid;

class ExpandRowColumn extends \kartik\grid\ExpandRowColumn
{
	public $noFormatHeader = false;
	
	public function init()
	{
		parent::init();
		
		if ($this->noFormatHeader)
		{
			$this->headerOptions = [];
		}
	}
}
