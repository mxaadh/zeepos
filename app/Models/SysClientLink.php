<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysClientLink extends Model
{
    // Table ka naam
    protected $table = 'tbl_Sys_ClientLink';

    // Agar primary key `id` nahi hai
    protected $primaryKey = 'CompanyId';

    // SQL Server database / schema specify karna ho to
    protected $connection = 'sqlsrv'; // ya jo bhi connection name .env me set hai
    protected $schema = 'dbo';

    // Agar table auto-incrementing nahi hai to
    public $incrementing = false;

    // Agar primary key int hai
    protected $keyType = 'int';

    // Timestamps agar table me nahi hain
    public $timestamps = false;

    // Columns jo mass-assignable hain
    protected $fillable = [
        'CompanyCode',
        'CompanyName',
        'CompanyShortName',
        'CompanyId',
        'ConnectionString',
        'ServerName',
        'DBname',
        'UN',
        'PW',
        'Project',
    ];
}
