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

namespace TinyPHP;

class Twig
{
	var $twig = null;
	
	
	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->create();
	}
	
	
	
	/**
	 * Create twig
	 */
	function create()
	{
		/* Restore twig */
		if ($this->twig != null)
		{
			return $this->twig;
		}
		
		$twig_opt = array
		(
			'autoescape'=>true,
			'charset'=>'utf-8',
			'optimizations'=>-1,
		);
		
		/* Twig cache */
		$twig_cache = true;
		if (defined("TWIG_CACHE"))
		{
			$twig_cache = TWIG_CACHE;
		}
		
		/* Enable cache */
		if ($twig_cache)
		{
			$twig_opt['cache'] = ROOT_PATH . '/var/cache/twig';
			$twig_opt['auto_reload'] = true;
		}
		
		/* Create twig loader */
		$twig_loader = new \Twig\Loader\FilesystemLoader();
		$twig_loader->addPath(ROOT_PATH . '/app/Templates', 'app');
		
		/* Create twig instance */
		$this->twig = new \Twig\Environment
		(
			$twig_loader,
			$twig_opt
		);
		
		/* Set strategy */
		$this->twig->getExtension(\Twig\Extension\EscaperExtension::class)->setDefaultStrategy('html');
		
		return $this->twig;
	}
	
	
	
	/**
	 * Render template
	 */
	function render($template, $context)
	{
		if (gettype($template) == 'array')
		{
			foreach ($template as $t)
			{
				try
				{
					$res = $this->twig->render($t, $context);
					return $res;
				}
				catch (\Twig\Error\LoaderError $err)
				{
				}
			}
		}
		else
		{
			return $this->twig->render($template, $context);
		}
		return "";
	}
	
}