<?php

namespace iggyvolz\ValveNetworking\Example;

use Symfony\Component\Console\Application;

class Chat extends Application
{
    public function __construct()
    {
        parent::__construct("Chat", "0.0.0");
        $this->add(new ChatServer());
        $this->add(new ChatClient());
    }
}