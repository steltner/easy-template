<?php declare(strict_types=1);

namespace Application\Handler;

use Application\FactoryTestCase;

class IndexHandlerFactoryTest extends FactoryTestCase
{
    public function testFactory(): void
    {
        $this->factory = new IndexHandlerFactory();

        $response = ($this->factory)($this->container);

        $this->assertInstanceOf(IndexHandler::class, $response);
    }
}
