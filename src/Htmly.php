<?php

namespace Htmly;

class Htmly {

	protected $body = '';
    protected $childBody = '';

    private $excludeAttr = ['content', 'child'];

	public function __call($name, $arguments)
    {
        if($name === 'print')
        {
            $toPrint = $this->body;
            $this->body = '';
            return $toPrint;
        }
        else{
            $this->body .= $this->createTag($name, $arguments);
            return $this;
        }
    }

    public static function __callStatic($name, $arguments)
    {
		if(is_array($arguments[0])){
            return call_user_func(array(new self, 'createTag'), $name, $arguments);
        }else{
            $trace = debug_backtrace();
            trigger_error('Method ' . $name . ' must have an array as argument, on line ' . $trace[0]['line'], E_USER_NOTICE);
            return null;
        }
    }

	private function createTag($type, array $arguments)
	{
        $content = $arguments[0]['content'];
        $insideContent = isset($arguments[0]['child']) ? $arguments[0]['child'] : '';
        $attrs = $this->renderAttr($arguments[0]);

        $openTag = "<$type $attrs>";
        $closeTag = "</$type>";

        return $openTag . $content . $insideContent . $closeTag;
	}

    private function renderAttr($arguments)
    {
        $attrs = '';
        foreach ($arguments as $attrIdx => $value) {
            if(!in_array($attrIdx, $this->excludeAttr))
            {
                $attrs .= $attrIdx . '="' . $this->buildAttr($attrIdx, $value) . '" ';
            }
        }
        return $attrs;
    }

    private function buildAttr($type, $value)
    {
        return is_array($value) ? implode(' ', $value) : $value;
    }
}