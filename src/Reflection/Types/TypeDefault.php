<?php 

/*
 * This file is part of the Xo\Dig package.
 *
 * (c) Abu Jobaer <itsunclexo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Xo\Dig\Reflection\Types;

use Xo\Dig\Contracts\Preparable;
use Xo\Dig\Reflection\AbstractReflectionType;

class TypeDefault extends AbstractReflectionType
{   
    public function prepare() 
    {
        return $this->param;
    }
}