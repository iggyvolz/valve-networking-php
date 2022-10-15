<?php

namespace iggyvolz\ValveNetworking\Example;

use Closure;
use FFI;
use iggyvolz\ValveNetworking\IPAddress;
use iggyvolz\ValveNetworking\ListenSocket;
use iggyvolz\ValveNetworking\SteamNetworkingSockets;
use Psr\Log\LoggerInterface;

class Server
{
    public function __construct(public readonly int $port, public readonly LoggerInterface $logger)
    {
        $address = IPAddress::parse("0.0.0.0", $this->port);
        SteamNetworkingSockets::get();
        $this->listenSock = new ListenSocket($address, /*function () {
            // OnSteamNetConnectionStatusChanged
        }*/);
    }

    // PollLocalUserInput
    public function handleInput(string $line): void
    {
        if($line === "/quit") {
            $this->quit = true;
            $this->logger->info("Shutting down server");
        } else {
            $this->logger->warning("The server only knows one command: '/quit'");
        }
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}