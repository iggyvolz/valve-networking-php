<?php

namespace iggyvolz\ValveNetworking;

use Closure;
use FFI;
use FFI\CData;

class ListenSocket
{
    private readonly int $socket;
    private readonly SteamNetworkingSockets $steamNetworkingSockets;

    public function __construct(
        public readonly IPAddress $address, private readonly ?Closure $connectionStatusChangedCallback = null
    )
    {
        $this->steamNetworkingSockets = SteamNetworkingSockets::get();
        $options = [];
        if($this->connectionStatusChangedCallback) {
            $options[] = $option = ValveNetworkingSDK::get()->ffi->new("struct SteamNetworkingConfigValue_t");
            $option->m_eValue = 201; // k_ESteamNetworkingConfig_Callback_ConnectionStatusChanged
            $option->m_eDataType = 5; // k_ESteamNetworkingConfig_Ptr
            $option->m_val->m_fn = $this->connectionStatusChangedCallback;
        }
        $optionBuf = FFI::new(FFI::arrayType(ValveNetworkingSDK::get()->ffi->type("struct SteamNetworkingConfigValue_t"), [count($options)]));
        foreach($options as $i => $option) {
            $optionBuf[$i] = $option;
        }
        $this->socket = ValveNetworkingSDK::get()->ffi->SteamAPI_ISteamNetworkingSockets_CreateListenSocketIP($this->steamNetworkingSockets->cdata, FFI::addr($this->address->pAddr), count($options), $optionBuf);
    }
}