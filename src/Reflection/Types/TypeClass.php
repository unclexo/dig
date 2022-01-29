<?php 

declare(strict_types = 1);

namespace Xo\Dig\Reflection\Types;

use Xo\Dig\Contracts\Preparable;
use Xo\Dig\Reflection\AbstractReflectionType;

class TypeClass extends AbstractReflectionType
{   
    public function prepare() 
    {
        return 'class';
    }
}