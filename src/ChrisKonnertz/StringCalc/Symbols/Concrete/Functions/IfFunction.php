<?php

namespace ChrisKonnertz\StringCalc\Symbols\Concrete\Functions;

use ChrisKonnertz\StringCalc\Exceptions\NumberOfArgumentsException;
use ChrisKonnertz\StringCalc\Symbols\AbstractFunction;

/**
 * PHP acos() function aka arc cosine. Expects one parameter.
 * @see http://php.net/manual/en/ref.math.php
 */
class IfFunction extends AbstractFunction
{

    /**
     * @inheritdoc
     */
    protected $identifiers = ['if'];

    /**
     * @inheritdoc
     * @throws NumberOfArgumentsException
     */
    public function execute(array $arguments)
    {
        $size = sizeof($arguments);
        if (!($size <= 3 && $size >= 2)) {
            throw new NumberOfArgumentsException('Error: Expected two or three arguments, got '.$size);
        }

        $cond = (bool)(int)$arguments[0];
        $ifTrue = $arguments[1];
        $ifFalse = isset($arguments[2]) ? $arguments[2] : false;

        return $cond?$ifTrue:$ifFalse;
    }

}