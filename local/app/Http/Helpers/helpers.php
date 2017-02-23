<?php namespace App\Http;
use \Route, \Config, \Session, \Redirect;
    class Helpers {
       
	public static function randomString($length = 10){
		return $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}
	
	public function url_title($str, $separator = '-', $lowercase = FALSE)
	{
		if ($separator == 'dash') 
		{
		    $separator = '-';
		}
		else if ($separator == 'underscore')
		{
		    $separator = '_';
		}
		
		$q_separator = preg_quote($separator);

		$trans = array(
			'&.+?;'                 => '',
			'[^a-z0-9 _-]'          => '',
			'\s+'                   => $separator,
			'('.$q_separator.')+'   => $separator
		);

		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		return trim($str, $separator);
	}
        
        
	
        public static function getRoute($type){
            
            $classaction = class_basename(Route::currentRouteAction());
            $routeArr = explode('@', $classaction);
            
            switch ($type) {
                case 'controller':
                    return $routeArr[0];
                break;
                case 'action':
                    return $routeArr[1];
                break;
                case 'alise':
                    return Route::currentRouteName();
                break;
            }
            //return Route::currentRouteName();
            //return class_basename(Route::currentRouteAction());
        }
		
	public static function  isActiveRoute($route, $output = "active")
	{
		if (Route::currentRouteName() == $route) return $output;
	}
        
    } //Class
