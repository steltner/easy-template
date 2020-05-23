<?php declare(strict_types=1);

namespace Application\Bin\Command;

use Bin\Command\ExampleCommand;
use Easy\Command\AbstractCommand;
use PHPUnit\Framework\TestCase;

class ExampleCommandTest extends TestCase
{
    public function testResponse()
    {
        $command = new ExampleCommand();

        $this->assertInstanceOf(AbstractCommand::class, $command);
    }
}
