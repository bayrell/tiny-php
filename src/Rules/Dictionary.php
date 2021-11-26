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

use TinyPHP\ApiCrudRoute;
use TinyPHP\Utils;


class Dictionary extends AbstractRule
{
	var $api_name = "";
	var $class_name = "";
	var $findQuery = null;
	var $fromDatabase = null;
	var $fields = null;
	var $actions = ["actionSearch", "actionGetById"];
	
	
	/**
	 * After query
	 */
	function afterQuery(ApiCrudRoute $route)
	{
		if ($this->api_name == null) return;
		if ($this->class_name == null) return;
		
		if (isset($route->action, $this->actions))
		{
			if (!isset($route->api_result->result["dictionary"]))
			{
				$route->api_result->result["dictionary"] = [];
			}
			
			$result = [];
			
			/* Get query */
			$class_name = $this->class_name;
			$query = $class_name::query();
			if ($this->findQuery) $query = $this->findQuery($query);
			
			/* Get items */
			$items = $query->get();
			foreach ($items as $item)
			{
				if ($this->fromDatabase)
				{
					$item = $this->fromDatabase($item);
				}
				if ($this->fields)
				{
					$item = Utils::object_intersect($item, $this->fields);
				}
				$result[] = $item;
			}
			
			$route->api_result->result["dictionary"][$this->api_name] = $result;
		}
		
	}
	
	
}