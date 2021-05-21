<?php


namespace ChrisKonnertz\StringCalc\Symbols\Concrete\Functions;


use ChrisKonnertz\StringCalc\Exceptions\NumberOfArgumentsException;
use ChrisKonnertz\StringCalc\Symbols\AbstractFunction;

class SumFunction extends AbstractFunction
{

    /**
     * @inheritdoc
     */
    protected $identifiers = ['sum'];



    public function execute(array $arguments)
    {
        $size = sizeof($arguments);

        if ($size < 1) {
            throw new NumberOfArgumentsException('Error: Expected least one arguments, got '.$size);
        }

        if ($size == 1) {
            return $arguments[0];
        }
        $sum = 0;
        foreach ($arguments as $argument) {
            $sum += $argument;
        }
        return $sum;
    }
}