<?php

/*
 * This file is part of the Static Class Interface.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\StaticClassInterface\Exception;

use LordDashMe\StaticClassInterface\Exception\FacadeException;

/**
 * Class Namespace Resolver Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class ClassNamespaceResolver extends FacadeException
{
    const IS_NOT_EXIST = 1;
    const IS_NOT_STRING = 2;

    public static function isNotExist(
        $message = 'The class namespace is not exist and can not be resolved.', 
        $code = ClassNamespaceResolver::IS_NOT_EXIST, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }

    public static function isNotString(
        $message = 'The given class namespace value is not a string and can not be resolved.', 
        $code = ClassNamespaceResolver::IS_NOT_STRING, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }
}