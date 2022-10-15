<?php

namespace iggyvolz\ValveNetworking\Example;

use iggyvolz\ValveNetworking\SteamNetworkingUtils;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand("server")]
class ChatServer extends Command
{

    protected function configure(): void
    {
        $this->addOption("port", mode: InputOption::VALUE_OPTIONAL, description: "Port to use", default: 27020);
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // InitSteamDatagramConnectionSockets
        $logger = new ConsoleLogger($output);
//        SteamNetworkingUtils::get()->setErrorHandler($logger);
        //echo IPAddress::parse("127.0.0.1", 12345) . PHP_EOL;
        // LocalUserInput_Init
        $server = new Server(intval($input->getOption("port")), $logger);
        echo __LINE__ . PHP_EOL;
        \Revolt\EventLoop::onReadable(STDIN, /** @param resource $socket */function(string $callbackId, $socket) use ($server) {
            $server->handleInput(trim(fgets($socket)));
        });
        // server.Run
        echo __LINE__ . PHP_EOL;
        \Revolt\EventLoop::run();
        echo __LINE__ . PHP_EOL;
        return Command::SUCCESS;
    }
}