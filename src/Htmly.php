<?php

namespace Htmly;

class Htmly {

	protected $body = '';

	public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        return dd( "Calling object method '$name' "
             . implode(', ', $arguments). "\n");
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
        // Note: value of $name is case sensitive.

		if(method_exists(self::class, '_'.$name)){
            // $this->{$property} = $arguments[0];
            $class = isset($arguments['class']) ? $arguments['class'] : null;
            $content = isset($arguments['content']) ? $arguments['content'] : $arguments[0];

            call_user_func(array(self::class, [$content, $class]));
        }else{
            $trace = debug_backtrace();
            trigger_error('Undefined method  ' . $name . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
            return null;
        }
    }

	public function _p($content, array $classes = null)
	{
		$classes = !is_null($classes) ? implode(' ', $classes) : $classes;
		return "<p class='$classes'>$content<p>";
	}
}