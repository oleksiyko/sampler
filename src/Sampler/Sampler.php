<?php

namespace Sampler;

/**
 * @author: Oleksii Postolovskyi<oleksii.postolovskyi@auto1.com>
 *
 * Class Sampler
 */
class Sampler
{
    /**
     * @var \Traversable
     */
    private $iterator;

    /**
     * @param \Traversable $iterator
     */
    public function __construct(\Traversable $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @param $size
     * @return array
     */
    public function sample($size)
    {
        $result = [];
        $i = 0;

        foreach ($this->iterator as $value) {
            if ($i < $size) {
                $result[$i] = $value;
            } else {
                $rand = rand(0, $i);
                if ($rand < $size) {
                    $result[$rand] = $value;
                }
            }
            $i++;
        }

        return $result;
    }
}
