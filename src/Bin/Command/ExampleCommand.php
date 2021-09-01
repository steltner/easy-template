<?php declare(strict_types=1);

namespace Bin\Command;

use Easy\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputOption;

class ExampleCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('example')
            ->addOption('project', 'p', InputOption::VALUE_OPTIONAL, 'Project name or short tag');
    }
}
