<?php

namespace iggyvolz\ValveNetworking;

use Closure;
use FFI;
use Psr\Log\LoggerInterface;

class SteamNetworkingSockets
{
    use WeakSingleton;
    private readonly ValveNetworkingSDK $sdk;
    /** @internal */public readonly mixed $cdata;
    // Need to keep reference alive
    private GameNetworkingSockets $gameNetworkingSockets;

    protected function __construct()
    {
        $this->sdk = ValveNetworkingSDK::get();
        $this->gameNetworkingSockets = GameNetworkingSockets::get();
        $this->cdata = $this->sdk->ffi->SteamNetworkingSockets_LibV12();
        var_dump($this->cdata);
    }

}