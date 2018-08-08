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
 * Class Namespace Resolver Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class ClassNamespaceResolver extends Base
{
    const ERROR_CODE_SERVICE_CLASS_NOT_EXIST = 100;

    public static function serviceClassIsNotExist($message = '', $code = null, $previous = null)
    {
        $message = 'The given service class namespace is not exist and can not be resolved.';

        return new static($message, self::ERROR_CODE_SERVICE_CLASS_NOT_EXIST, $previous);
    }
}