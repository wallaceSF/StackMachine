<?php

/**
 * @param string $stringStack
 * @return int
 */
function processStackMachine(string $stringStack): int
{
    $pattern = '/[^A-Z\\+\\-]/';
    $compatibleElements   = preg_split($pattern, $stringStack);

    $stringStackArray = explode(' ', $stringStack);
    $stack            = new SplStack();
    foreach ($stringStackArray as $item) {
        if (is_numeric($item)) {
            $stack->push((int)$item);
        }

        if (!in_array($item, $compatibleElements) && !is_numeric($item)) {
            throw new \InvalidArgumentException("O operador '{$item}' não é compativel");
        }

        if ($item == 'DUP') {
            $dup = $stack->top();
            $stack->push($dup);
        }

        if ($item == 'POP') {
            $firstElement = $stack->count() - $stack->count();
            $stack->offsetUnset($firstElement);
        }

        if ($item == '+') {
            $firstIndex  = $stack->count() - $stack->count();
            $secondIndex = ($stack->count() - $stack->count()) + 1;
            $soma        = $stack->offsetGet($firstIndex) + $stack->offsetGet($secondIndex);
            $stack->offsetUnset($secondIndex);
            $stack->offsetUnset($firstIndex);
            $stack->push($soma);
        }

        if ($item == '-') {
            $firstIndex  = $stack->count() - $stack->count();
            $secondIndex = ($stack->count() - $stack->count()) + 1;
            $soma        = $stack->offsetGet($firstIndex) - $stack->offsetGet($secondIndex);
            $stack->offsetUnset($secondIndex);
            $stack->offsetUnset($firstIndex);
            $stack->push($soma);
        }
    }
    return $stack->top();
}

$stringStack = "9 3 +";

echo processStackMachine($stringStack);
