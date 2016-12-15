<?php

namespace Sampler\Tests;
use Sampler\Sampler;

/**
 * @autor: Oleksii Postolovskyi<oleksii.postolovskyi@auto1.com>
 *
 * Class SamplerTest
 */
class SamplerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sampler
     */
    private $sampler;

    public function setUp()
    {
        $this->sampler = new Sampler(new \ArrayIterator(range(0,1000)));
    }

    public function testSample()
    {
        $this->assertCount(1, $this->sampler->sample(1));
        $this->assertCount(100, $this->sampler->sample(100));
    }
}
