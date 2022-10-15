<?php

namespace iggyvolz\ValveNetworking;

use FFI;
use FFI\CData;

class IPAddress
{

    /**
     * @param CData $pAddr
     * @internal
     */
    public function __construct(/** @internal */public readonly CData $pAddr)
    {
    }

    public static function parse(string $address, int $port): self
    {
        $sdk = ValveNetworkingSDK::get();
        $pAddr = $sdk->ffi->new("struct SteamNetworkingIPAddr");
        $sdk->ffi->SteamAPI_SteamNetworkingIPAddr_ParseString(FFI::addr($pAddr), $address);
        $pAddr->m_port = $port;
        return new self($pAddr);
    }

    public function __toString(): string
    {
        $sdk = ValveNetworkingSDK::get();
        $buf = FFI::new("char[256]");
        $sdk->ffi->SteamAPI_SteamNetworkingIPAddr_ToString($sdk->ffi->cast("struct SteamNetworkingIPAddr*", FFI::addr($this->pAddr)), $buf, FFI::sizeof($buf), true);
        return FFI::string($buf, FFI::sizeof($buf));
    }
}