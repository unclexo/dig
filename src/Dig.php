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

namespace Xo\Dig;

use Symfony\Component\VarDumper\VarDumper;
use Xo\Dig\Factory\ReflectionTypeFactory;

final class Dig 
{
    /** @var Xo\Dig\Factory\ReflectionTypeFactory */
	private static $reflectionTypeFactory;

    /**
     * Private constructor to disallow create instance
     * 
     * @param \Xo\Dig\Factory\ReflectionTypeFactory $reflectionTypeFactory
     */
	private function __construct(ReflectionTypeFactory $reflectionTypeFactory) 
	{
		self::$reflectionTypeFactory = $reflectionTypeFactory;
	}

    /**
     * Stop cloning the object creating from Dig
     */
	private function __clone() {}

    /**
     * Create instance of itself within this class only
     * 
     * @return \Xo\Dig\Dig
     */
	private static function newInstance() 
	{
		return new self(new ReflectionTypeFactory());
	}

    /**
     * Allow you to dig function, class, object and variable
     * 
     * @param mixed $param
     * @return void
     */
	public static function it($param) 
	{
		$dig = self::newInstance();

		$reflectionType = self::$reflectionTypeFactory::from($param);
		$preparedValue = $reflectionType->prepare();

		VarDumper::dump($preparedValue);
	}
}