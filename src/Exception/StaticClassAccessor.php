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
 * Static Class Accessor Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class StaticClassAccessor extends FacadeException
{
    const IS_NOT_DECLARED = 1;

    public static function isNotDeclared(
        $message = 'The "getStaticClassAccessor()" method is not declared by the successor class.', 
        $code = StaticClassAccessor::IS_NOT_DECLARED, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }
}