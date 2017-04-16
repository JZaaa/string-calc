## [WIP] PHP calculator for mathematical terms (expressions) passed as strings

This library is in a very early state (pre-alpha) and does not work at the moment.

TODO / Missing: 
* Deal with unary operators
* Care for operator precedence (WIP)
* Grammar checking
* Actual calculation
* Add function for 7E-10 numbers?
* Make injectable grammar checker?

## The term

Example, we need an example! Here we go: `2*(pi-abs(-0.4))`

This is a mathematical term following syntactical and grammatical rules that StringCalc understands. 
Syntax and grammar of these terms are very similar to what you would write in PHP code. 
To be more precise, there is an intersecting set of syntactical and grammatical rules. 
There are some exceptions but usually you will be able to write terms for StringCalc 
by pretending that you are writing PHP code. 

## Types of symbols

A term consists of symbols that are from a specific type. This section list all available symbol types.

### Numbers

Numbers in a term always consist of digits and may include one period. Good examples:

```
0
00
123
4.56
.7
```

Bad examples:

```
0.1.2   // Two periods
2.2e3   // "e" will work in PHP code but not in a term
7E-10   // "E" will work in PHP code but not in a term
```

Just for your information: From the tokenizer's point of view, numbers in a term are always positive. 
This means that the tokenizer will split the term `-1` in two parts: `-` and `1`. 

> Notice: The fractional part of a PHP float can only have a limited length. If a number in a term has a longer 
fractional part, the fractional part will be cut somewhere.

#### Number implementation

There is only one concrete number class: `Symbols\Concrete\Number`. 
It extends the abstract class `Symbols\AbstractNumber`. 

### Brackets

There are two types of brackets in a term: Opening and closing brackets. There is no other typification. For example 
there can be classes that implement support for parentheses `()` and square brackets `[]` 
but they will be treated equally. Therefore this is a valid term even though it might not be valid 
from a mathematical point of view: `[1+)`

For every opening brackets there must be a closing bracket and vice versa. Good examples:
                                                                           
```
(1+1)
(1)
((1+2)*(3+4))
```

Bad examples:

```
(1+1    // Missing closing bracket
)1+1(   // Missing opening bracket for the closing bracket,
        // missing closing bracket for the open bracket
```

#### Bracket implementation

The `Symbols\AbstractBracket` class is the base class for all brackets. It is extended by the abstract classes
`Symbols\AbstractOpeningBracket` and `Symbols\AbstractClosingBracket`. These are extended by concrete classes: 
`Symbols\Concrete\OpeningBracket` and `Symbols\Concrete\ClosingBracket`. These classes do not implement behaviour.

### Constants

...

### Operators

Operators in a term can be unary or binary or even both. However, if they are unary, they have to follow
 prefix notation (example: "-1"). 

#### Operator implementation

The `Symbols\AbstractOperator` class is the base class for all operators. 
There are several concrete operators that extend this class.

Please be aware that operators are closely related to functions. Functions are at least as powerful as operators are.

Operator classes implement the `operate($leftNumber, $rightNumber)` method. Its parameters represent the operands.
It might be confisuing that even if the operator is a unary operator its `operate` method needs to have offer
both parameters. The `$rightNumber` parameter will contain the operand of the unary operation.

### Functions

...

## Notes

* Internally this library uses PHP's mathematical constants, operators and functions to calculate the term. 
Therefore - as a rule of thumb - please transfer your knowledge about mathematics in PHP to the mathematics 
in StringCalc.  

* This class does not offer support for any other numeral system than the decimal numeral system. 
It is not intended to provide such support so if you need support of other numeral system 
(such as the binary numeral system) this might not be the library of your choice. 