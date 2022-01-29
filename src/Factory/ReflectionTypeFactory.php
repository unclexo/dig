<?php 

/*
 * This file is part of the Xo\Dig package.
 *
 * (c) Abu Jobaer <itsunclexo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xo\Dig\Factory;

use Xo\Dig\Reflection\Types\TypeClass;
use Xo\Dig\Reflection\Types\TypeDefault;
use Xo\Dig\Reflection\Types\TypeFunction;
use Xo\Dig\Reflection\Types\TypeObject;

class ReflectionTypeFactory 
{
    /**
     * Create an instance of reflection-type
     * 
     * @param mixed $param
     */
    public static function from($param) 
    {
        switch ($param) {            
            case is_object($param):
                return new TypeObject($param);
            case class_exists($param):
                return new TypeClass($param);
            case function_exists($param):
                return new TypeFunction($param);
            default;
                return new TypeDefault($param);
        }
    }
}