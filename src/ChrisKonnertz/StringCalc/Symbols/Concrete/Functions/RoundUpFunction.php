<?php


namespace ChrisKonnertz\StringCalc\Symbols\Concrete\Functions;


use ChrisKonnertz\StringCalc\Exceptions\NumberOfArgumentsException;
use ChrisKonnertz\StringCalc\Symbols\AbstractFunction;

class RoundUpFunction extends AbstractFunction
{

    /**
     * @inheritdoc
     */
    protected $identifiers = ['roundUp'];

    public function execute(array $arguments)
    {
        $size = sizeof($arguments);
        if (!($size <= 2 && $size >= 1)) {
            throw new NumberOfArgumentsException('Error: Expected one or two arguments, got '.$size);
        }
        $number = $arguments[0];
        $precision = isset($arguments[1]) ? $arguments[1] : 0;
        if ($number == 0) {
            return $number;
        }

        if ($number < 0.0) {
            return round($number - 0.5 * 0.1 ** $precision, $precision, PHP_ROUND_HALF_DOWN);
        }

        return round($number + 0.5 * 0.1 ** $precision, $precision, PHP_ROUND_HALF_DOWN);
    }
}