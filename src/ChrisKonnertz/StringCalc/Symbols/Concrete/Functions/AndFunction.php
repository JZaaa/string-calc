<?php


namespace ChrisKonnertz\StringCalc\Symbols\Concrete\Functions;


use ChrisKonnertz\StringCalc\Exceptions\NumberOfArgumentsException;
use ChrisKonnertz\StringCalc\Symbols\AbstractFunction;

class AndFunction extends AbstractFunction
{

    /**
     * @inheritdoc
     */
    protected $identifiers = ['and'];


    public function execute(array $arguments)
    {
        if (sizeof($arguments) < 1) {
            throw new NumberOfArgumentsException('Error: Expected least one arguments, got '.sizeof($arguments));
        }

        $args = array_filter($arguments, function ($value) {
            return $value !== null || (is_string($value) && trim($value) == '');
        });

        $trueValueCount = 0;
        foreach ($args as $arg) {
            if (is_bool($arg)) {
                $trueValueCount += $arg;
            } elseif ((is_numeric($arg)) && (!is_string($arg))) {
                $trueValueCount += ((int) $arg != 0);
            } elseif (is_string($arg)) {
                $arg = strtoupper($arg);
                if ($arg == 'FALSE') {
                    $arg = false;
                } else {
                    $arg = true;
                }
                $trueValueCount += ($arg != 0);
            }
        }
        $argCount = sizeof($args);
        return ($trueValueCount > 0) && ($trueValueCount == $argCount);
    }
}