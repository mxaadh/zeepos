<?php

namespace App\Models\Tenant;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TenantUser extends Authenticatable
{
    // Hit the dynamic tenant DB that you set via TenantDatabase::connect(...)
    protected $connection = 'tenant';

    protected $table = 'tbl_02_10_Users';
    protected $primaryKey = 'Userno';
    public $timestamps = false;
    protected $keyType = 'int';
    public $incrementing = true;

    // Non-standard columns
    protected $fillable = [
        'UserName', 'PassWord', 'Role', 'IsActive', 'Dropped', 'CompanyId', 'EmpNo', 'Project',
        'Module_01','Module_02','Module_03','Module_04','Module_05','Module_06','Module_07','Module_08',
        'Module_09','Module_10','Module_11','Module_12','Module_13','Module_14','Module_15','Module_16','Module_17','Module_18',
    ];

    protected $hidden = ['PassWord'];

    // Tell Laravel which column stores the hashed password
    public function getAuthPasswordName()
    {
        return 'PassWord';
    }

    public function getAuthPassword()
    {
        return $this->PassWord;
    }
}
