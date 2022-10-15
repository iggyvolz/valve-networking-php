#define FFI_LIB "libGameNetworkingSockets.so"
typedef unsigned char uint8;
typedef signed char int8;
typedef short int16;
typedef unsigned short uint16;
typedef int int32;
typedef unsigned int uint32;
typedef long long int64;
typedef unsigned long long uint64;
struct IPv4MappedAddress {
    uint64 m_8zeros;
    uint16 m_0000;
    uint16 m_ffff;
    uint8 m_ip[ 4 ]; // NOTE: As bytes, i.e. network byte order
};
struct SteamNetworkingIPAddr
{
	union
	{
		uint8 m_ipv6[ 16 ];
		struct IPv4MappedAddress m_ipv4;
	};
	uint16 m_port; // Host byte order
};
typedef char SteamNetworkingErrMsg[ 1024 ];
bool SteamAPI_SteamNetworkingIPAddr_ParseString( struct SteamNetworkingIPAddr* self, const char *pszStr );
void SteamAPI_SteamNetworkingIPAddr_ToString( const struct SteamNetworkingIPAddr* self, char *buf, size_t cbBuf, bool bWithPort );
bool GameNetworkingSockets_Init( const void *pIdentity, SteamNetworkingErrMsg *errMsg );
void GameNetworkingSockets_Kill();
struct ISteamNetworkingUtils;
struct ISteamNetworkingUtils *SteamNetworkingUtils_LibV4();
// If you're using the Steam API
//struct ISteamNetworkingUtils *SteamNetworkingUtils_SteamAPI();
typedef uint32 ESteamNetworkingSocketsDebugOutputType;
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
typedef uint32 ESteamNetworkingConfigValue;
typedef uint32 ESteamNetworkingConfigDataType;
struct SteamNetworkingConfigValue_t
{
	/// Which option is being set
	ESteamNetworkingConfigValue m_eValue;

	/// Which field below did you fill in?
	ESteamNetworkingConfigDataType m_eDataType;

	/// Option value
	union
	{
		int32_t m_int32;
		int64_t m_int64;
		float m_float;
		const char *m_string; // Points to your '\0'-terminated buffer
		void* m_ptr;
		void(*m_fn)(); // hack for PHP complaining about casting functions to pointers
	} m_val;
};
typedef void (*FSteamNetworkingSocketsDebugOutput)( ESteamNetworkingSocketsDebugOutputType nType, const char *pszMsg );
void SteamAPI_ISteamNetworkingUtils_SetDebugOutputFunction( struct ISteamNetworkingUtils* self, ESteamNetworkingSocketsDebugOutputType eDetailLevel, FSteamNetworkingSocketsDebugOutput pfnFunc );
struct ISteamNetworkingSockets *SteamNetworkingSockets_LibV12();
typedef uint32 HSteamListenSocket;
HSteamListenSocket SteamAPI_ISteamNetworkingSockets_CreateListenSocketIP( struct ISteamNetworkingSockets* self, const struct SteamNetworkingIPAddr* localAddress, int nOptions, const struct SteamNetworkingConfigValue_t * pOptions );
