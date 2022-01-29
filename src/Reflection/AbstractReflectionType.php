<?php 

namespace Xo\Dig\Reflection;


abstract class AbstractReflectionType
{   
    protected $param;

    public function __construct($param) 
    {
        $this->param = $param;
    }
    
    abstract public function prepare();
}