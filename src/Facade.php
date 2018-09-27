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

use LordDashMe\StaticClassInterface\Exception\StaticClassAccessorException;
use LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolverException;

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
    protected static function setClass($classNamespace, $classInstance)
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
    protected static function getClass($classNamespace)
    {
        if (isset(self::$class[$classNamespace])) {
            return self::$class[$classNamespace];
        }

        return false;
    }

    /**
     * Handle all the methods that will lead to service class capability.
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
        
        if (! $resolvedClassInstance) {
            return self::resolveClassNameSpace($classNamespace);  
        }

        return $resolvedClassInstance;
    }

    /**
     * Resolver for service class namespace.
     * Set the resolved service class instance to the class property.
     *
     * @param  string  $classNamespace
     * 
     * @throws LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver::isNotString
     * @throws LordDashMe\StaticClassInterface\Exception\ClassNamespaceResolver::isNotExist
     *
     * @return mixed
     */
    protected static function resolveClassNameSpace($classNamespace)
    {
        if (! \is_string($classNamespace)) {
            throw ClassNamespaceResolverException::isNotString();
        }

        if (! \class_exists($classNamespace)) {
            throw ClassNamespaceResolverException::isNotExist();
        }

        $classNamespace = self::classNamespaceDecorator($classNamespace);

        $classInstance = new $classNamespace();

        self::setClass($classNamespace, $classInstance);

        return $classInstance;
    }

    /**
     * This method decorate the class namespace, adding a default backslash 
     * in the first character to avoid the namespace scope issue.
     * 
     * @param  string  $classNamespace
     * 
     * @return string
     */
    protected static function classNamespaceDecorator($classNamespace)
    {
        if ($classNamespace[0] !== '\\') {
            return \substr_replace($classNamespace, '\\', 0, 0);
        }

        return $classNamespace;
    }

    /**
     * Get the service class namespace that will be convert into static class.
     *
     * @throws LordDashMe\StaticClassInterface\Exception\StaticClassAccessor::isNotDeclared
     * 
     * @return string
     */
    protected static function getStaticClassAccessor()
    {
        throw StaticClassAccessorException::isNotDeclared();
    }
}
