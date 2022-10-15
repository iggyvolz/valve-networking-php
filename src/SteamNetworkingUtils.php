<?php

namespace iggyvolz\ValveNetworking;

use FFI\CData;
use Psr\Log\LoggerInterface;

class SteamNetworkingUtils
{
    use WeakSingleton;
    private readonly CData $cdata;
    public function __construct()
    {
        $this->sdk = ValveNetworkingSDK::get();
        $this->cdata = $this->sdk->ffi->SteamNetworkingUtils_LibV4(); // TODO steam API
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function errorHandler(int $x, string $y): void
    {
        var_dump([]);
    }

    public function setErrorHandler(LoggerInterface $logger): void
    {
        $this->sdk->ffi->SteamAPI_ISteamNetworkingUtils_SetDebugOutputFunction($this->cdata, DebugOutputType::Everything->value, $this->errorHandler(...));

    }
}