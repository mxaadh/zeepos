<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TenantDatabase
{
    /**
     * Build & (re)connect a "tenant" connection from a SysClientLink row.
     * @param  object|array  $client  // expects CompanyCode, ServerName, DBname, UN, PW
     * @throws \RuntimeException on failure
     */
    public static function connect($client, string $name = 'tenant'): void
    {
        $client = (object) $client;

        // Define connection at runtime
        Config::set("database.connections.$name", [
            'driver'                  => 'sqlsrv',
            'host'                    => $client->ServerName,
            'port'                    => env('DB_PORT', 1433),
            'database'                => $client->DBname,
            'username'                => $client->UN,
            'password'                => $client->PW,
            'charset'                 => 'utf8',
            'prefix'                  => '',
            'prefix_indexes'          => true,
            // SQL Server TLS knobs — tweak per your server policy:
            'encrypt'                 => env('SQLSRV_ENCRYPT', 'yes'),
            'trust_server_certificate'=> env('SQLSRV_TRUST_CERT', 'true'),
            'appname'                 => config('app.name'),
        ]);

        // Drop any stale connection and reconnect fresh
        DB::purge($name);

        try {
            DB::connection($name)->getPdo(); // handshake test
        } catch (QueryException $e) {
            throw new \RuntimeException(
                "Failed to connect tenant DB ({$client->CompanyCode}@{$client->ServerName}/{$client->DBname}): ".$e->getMessage(),
                previous: $e
            );
        }
    }
}
