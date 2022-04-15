<?php

/*!
 *  Tiny PHP Framework
 *
 *  MIT License
 *
 *  Copyright (c) 2020 - 2021 "Ildar Bikmamatov" <support@bayrell.org>
 * 
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 */

namespace TinyPHP\Rules;

use Illuminate\Database\Eloquent\Model;
use TinyPHP\ApiCrudRoute;
use TinyPHP\Utils;


class AllowFields extends AbstractRule
{
    var $fields = null;


	/**
	 * From database
	 */
	function fromDatabase($action, $item, $old_item)
	{
        if ($this->fields === null) return $item;
		$item = Utils::object_intersect($item, $this->fields);
		return $item;
    }


    /**
	 * To database
	 */
	function toDatabase($action, $item, $old_item)
	{
        if ($this->fields === null) return $item;
		$item = Utils::object_intersect($item, $this->fields);
		return $item;
    }
    
	
	
	/**
	 * Process item before query
	 */
	function processItem($action)
	{
		if ($this->fields === null) return;
		
		//$this->
		
		//$item = Utils::object_intersect($item, $this->fields);
		//return $item;
	}
	
}