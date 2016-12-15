<?php

namespace Sampler\Iterator;

/**
 * @author: Oleksii Postolovskyi<oleksii.postolovskyi@auto1.com>
 *
 * Class ResourceIterator
 */
class ResourceIterator implements \IteratorAggregate
{
    /**
     * @var resource
     */
    private $pointer;

    public function __construct($pointer)
    {
        if (!$pointer) {
            throw new \InvalidArgumentException('Argument should be valid pointer');
        }
        $this->pointer = $pointer;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        while ($char = fgetc($this->pointer)) {
            yield $char;
        }
        fclose($this->pointer);
    }
}
