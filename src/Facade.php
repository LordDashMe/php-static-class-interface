<?php

/*
 * This file is part of the Static Class Interface.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\StaticClassInterface;

use LordDashMe\StaticClassInterface\Exception\StaticClassAccessor;
use LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver;

/**
 * The Facade Class. 
 *
 * A simple package that convert a service class into a static-like class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Facade
{
    /**
     * Store all the resolved service class instance.
     *
     * @var array
     */
    protected static $class = [];

    /**
     * Store the resolved service class instance that will be use later.
     *
     * @param  string  $classNamespace
     * @param  mixed   $classInstance
     *
     * @return void
     */
    public static function setClass($classNamespace, $classInstance)
    {
        self::$class[$classNamespace] = $classInstance;
    }

    /**
     * Get the resolved service class instance of the given class namespace.
     *
     * @param  string  $classNamespace
     *
     * @return mixed
     */
    public static function getClass($classNamespace)
    {
        if (isset(self::$class[$classNamespace])) {
            return self::$class[$classNamespace];
        }

        return false;
    }

    /**
     * Handles all the methods that will lead to service class capability.
     *
     * @param  string  $method
     * @param  array   $args
     * 
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $classInstance = self::getResolvedClassInstance();

        return $classInstance->{$method}(...$args);
    }

    /**
     * Check if the class namespace already have a cached resolved instance,
     * if not then the class namespace must be resolve.
     *
     * @return mixed
     */
    protected static function getResolvedClassInstance()
    {
        $classNamespace = static::getStaticClassAccessor();
        
        $resolvedClassInstance = self::getClass($classNamespace);
        
        if ($resolvedClassInstance) {
            return $resolvedClassInstance;
        }

        return self::resolveClassNameSpace($classNamespace);
    }

    /**
     * Resolver for service class namespace.
     * Set the resolved service class instance to the class property.
     *
     * @param  string  $classNamespace
     * 
     * @throws LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver
     *
     * @return mixed
     */
    protected static function resolveClassNameSpace($classNamespace)
    {
        if (! \class_exists($classNamespace)) {
            throw ClassNamespaceResolver::serviceClassIsNotExist();
        }

        $classInstance = new $classNamespace();

        self::setClass($classNamespace, $classInstance);

        return $classInstance;
    }

    /**
     * Get the service class namespace that will be convert into static class.
     *
     * @throws LordDashMe\StaticClassInterface\Exception\StaticClassAccessor
     * 
     * @return string
     */
    protected static function getStaticClassAccessor()
    {
        throw StaticClassAccessor::isNotDeclared();
    }
}