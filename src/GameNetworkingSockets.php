<?php

namespace iggyvolz\ValveNetworking;

use FFI;
use Psr\Log\LoggerInterface;

class GameNetworkingSockets
{
    use WeakSingleton;
    private readonly ValveNetworkingSDK $sdk;

    protected function __construct()
    {
        $this->sdk = ValveNetworkingSDK::get();
        $errBuf = FFI::new("char[1024]");
        if(!$this->sdk->ffi->GameNetworkingSockets_Init(null, FFI::addr($errBuf))) {
            throw new GameNetworkingSocketsException(FFI::string($errBuf));
        }
        echo "GameNetworkingSockets_Init\n";
    }
    public function __destruct()
    {
        $this->sdk->ffi->GameNetworkingSockets_Kill();
        echo "GameNetworkingSockets_Kill\n";
        debug_print_backtrace();
    }
}