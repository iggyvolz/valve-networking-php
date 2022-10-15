<?php
namespace iggyvolz\ValveNetworking;
use FFI;

class ValveNetworkingSDK
{
    use WeakSingleton;
    /** @internal  */
    public readonly FFI $ffi;
    protected function __construct()
    {
        $this->ffi = FFI::load(__DIR__ . "/valvenetworking.h") ?? throw new \RuntimeException("Could not load FFI");
    }
}