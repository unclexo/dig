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

use ReflectionObject;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionNamedType;
use Xo\Dig\Reflection\AbstractReflectionType;

class TypeObject extends AbstractReflectionType
{
	public function prepare() 
	{
		$reflectionObject = new ReflectionObject($this->param);

		$methods = [
			'object' => $reflectionObject->getName(),
			'extends' => $reflectionObject->getParentClass() ? $reflectionObject->getParentClass()->getName() : null,
			'implements' => $this->prepareInstances($reflectionObject->getInterfaces()),
			'methods' => $this->prepareMethods($reflectionObject->getMethods()),
			'properties' => $this->prepareProperties($reflectionObject->getProperties()),
			'constants' => $this->prepareProperties($reflectionObject->getConstants()),
		];

		return $methods;
	}

    private function prepareInstances($instances) 
    {
        $instanceInfoArray = [];

        foreach ($instances as $reflectionClass) {
            $instanceInfoArray[] = $reflectionClass->getName();
        }

        return $instanceInfoArray;
    }

	private function prepareMethods($methods) 
	{
		$methodInfoArray = [];

		foreach ($methods as $method) {
			if ($method instanceof ReflectionMethod) {
				$parameters = [];
				foreach ($method->getParameters() as $parameter) {
					if ($parameter instanceof ReflectionParameter) {
						$parameters[$parameter->getName()] = [
							'value' => $parameter->isDefaultValueAvailable() 
								? $parameter->getDefaultValue()
								: null,
							'type' => ($parameter->getType() instanceof ReflectionNamedType) 
								? $parameter->getType()->getName()
								: $parameter->getType(),
							'position' => $parameter->getPosition(),
							'optional' => $parameter->isOptional(),
							'callable' => $parameter->isCallable(),
							'array' => $parameter->isArray(),
							'passedByReference' => $parameter->isPassedByReference(),
							'variadic' => $parameter->isVariadic(),
						];
					}
				}

				$methodInfoArray[$method->getName()] = [
					'return' => $method->getReturnType(),
					'parameters' => $parameters,
				];
			}
		}

		return $methodInfoArray;
	}

    private function prepareProperties($properties) 
	{
        $propertyInfoArray = [];

        foreach ($properties as $property) {
            $propertyInfoArray[$property->getName()] = [
                'class' => $property->getDeclaringClass()->getName(),
                'modifier' => $property->getModifiers(),
                // 'value' => $property->getValue(),
                'static' => $property->isStatic(),
                'doc' => $property->getDocComment(),
            ];
        }

        return $propertyInfoArray;
	}

	private function prepareConstants($constants) 
	{
        $constantInfoArray = [];

        foreach ($constants as $constant) {
            $constantInfoArray[$constant->getName()] = [
                'class' => $constant->getDeclaringClass()->getName(),
                'modifier' => $constant->getModifiers(),
                'value' => $constant->getValue(),
                'doc' => $constant->getDocComment(),
            ];
        }

        return $constantInfoArray;
	}
}