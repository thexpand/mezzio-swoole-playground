<?php

declare(strict_types=1);

namespace App\Command;

use Dotenv\Dotenv;
use Mezzio\Swoole\Command\StartCommand as MezzioSwooleStartCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends MezzioSwooleStartCommand
{
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        if (file_exists(getcwd() . '/.env')) {
            $dotenv = Dotenv::createImmutable(getcwd());
            $dotenv->load();
        }

        return parent::execute($input, $output);
    }
}
