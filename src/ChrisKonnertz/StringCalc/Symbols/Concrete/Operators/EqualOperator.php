<?php


namespace ChrisKonnertz\StringCalc\Symbols\Concrete\Operators;


use ChrisKonnertz\StringCalc\Symbols\AbstractOperator;


/**
 * Operator for comparison '=', same as '=='
 * Example: "1=2" => 0
 *
 */
class EqualOperator extends AbstractOperator
{
    /**
     * @inheritdoc
     */
    protected $identifiers = ['='];

    /**
     * @inheritdoc
     */
    const PRECEDENCE = 85;

    /**
     * @inheritdoc
     */
    public function operate($leftNumber, $rightNumber)
    {
        return (int)($leftNumber == $rightNumber);
    }
}