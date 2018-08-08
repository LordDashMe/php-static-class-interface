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

use LordDashMe\StaticClassInterface\Exception\Base;

/**
 * Static Class Accessor Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class StaticClassAccessor extends Base
{
    const ERROR_CODE_UNRESOLVED_ACCESSOR = 100;

    public static function isNotDeclared($message = '', $code = null, $previous = null)
    {
        $message = 'The (getStaticClassAccessor) function is not declared by the successor class.';

        return new static($message, self::ERROR_CODE_UNRESOLVED_ACCESSOR, $previous);
    }
}