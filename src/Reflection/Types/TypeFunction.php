<?php 

declare(strict_types = 1);

namespace Xo\Dig\Reflection\Types;

use Xo\Dig\Reflection\AbstractReflectionType;

class TypeFunction extends AbstractReflectionType
{
    public function prepare() 
    {
        return 'function';
    }
}