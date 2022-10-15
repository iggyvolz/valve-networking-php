<?php

namespace iggyvolz\ValveNetworking;
//enum ESteamNetworkingSocketsDebugOutputType
//{
//    k_ESteamNetworkingSocketsDebugOutputType_None = 0,
//    k_ESteamNetworkingSocketsDebugOutputType_Bug = 1, // You used the API incorrectly, or an internal error happened
//    k_ESteamNetworkingSocketsDebugOutputType_Error = 2, // Run-time error condition that isn't the result of a bug.  (E.g. we are offline, cannot bind a port, etc)
//    k_ESteamNetworkingSocketsDebugOutputType_Important = 3, // Nothing is wrong, but this is an important notification
//    k_ESteamNetworkingSocketsDebugOutputType_Warning = 4,
//    k_ESteamNetworkingSocketsDebugOutputType_Msg = 5, // Recommended amount
//    k_ESteamNetworkingSocketsDebugOutputType_Verbose = 6, // Quite a bit
//    k_ESteamNetworkingSocketsDebugOutputType_Debug = 7, // Practically everything
//    k_ESteamNetworkingSocketsDebugOutputType_Everything = 8, // Wall of text, detailed packet contents breakdown, etc
//
//    k_ESteamNetworkingSocketsDebugOutputType__Force32Bit = 0x7fffffff
//};
use Psr\Log\LogLevel;

enum DebugOutputType: int
{
    case None = 0;
    case Bug = 1;
    case Error = 2;
    case Important = 3;
    case Warning = 4;
    case Msg = 5;
    case Verbose = 6;
    case Debug = 7;
    case Everything = 8;
    public static function fromPsr(string $logLevel): self
    {
        return match($logLevel) {
            LogLevel::EMERGENCY => self::Bug,
            LogLevel::ALERT => self::Error,
            LogLevel::CRITICAL => self::Important,
            LogLevel::ERROR => self::Warning,
            LogLevel::WARNING => self::Msg,
            LogLevel::NOTICE => self::Verbose,
            LogLevel::INFO => self::Debug,
            LogLevel::DEBUG => self::Everything,
        };
    }
    public function toPsr(): ?string
    {
        return match($this) {
            self::Bug => LogLevel::EMERGENCY,
            self::Error => LogLevel::ALERT,
            self::Important => LogLevel::CRITICAL,
            self::Warning => LogLevel::ERROR,
            self::Msg => LogLevel::WARNING,
            self::Verbose => LogLevel::NOTICE,
            self::Debug => LogLevel::INFO,
            self::Everything => LogLevel::DEBUG,
            self::None => null,
        };
    }
}
