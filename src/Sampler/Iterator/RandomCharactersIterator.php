<?php

namespace Sampler\Iterator;

/**
 * @author: Oleksii Postolovskyi<oleksii.postolovskyi@auto1.com>
 *
 * Class RandomCharactersIterator
 */
class RandomCharactersIterator implements \IteratorAggregate
{
    const DEFAULT_SIZE = 10000;
    /**
     * @var int
     */
    private $size;

    public function __construct($size = self::DEFAULT_SIZE)
    {
        $this->size = $size;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        $chars = range('a','z');
        for($i = 0; $i < $this->size; $i++) {
            $randValue = $chars[rand(0, count($chars) - 1)];
            yield $randValue;
        }
    }
}
