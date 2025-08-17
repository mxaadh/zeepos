<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Use the dynamic tenant connection (set via your tenant resolver)
    protected $connection = 'tenant';

    // Include schema for SQL Server
    protected $table = 'tbl_01_10_Client';

    // Primary key is a non-incrementing string (likely the ClientCode)
    protected $primaryKey = 'ClientCode';
    public $incrementing = false;
    protected $keyType = 'string';

    // Table has no created_at / updated_at
    public $timestamps = false;

    // Mass-assignable columns
    protected $fillable = [
        'ClientCode',
        'Name',
        'Address',
        'Logo',
        'Party',
        'Abrv',
        'STaxRegNo',
        'NTN',
        'NatureOfBusiness',
        'TitleofTax',
        'TaxPercentage',
        'SellerName',
        'IsActive',
        'PlotSizeCategory',
        'Email',
        'PhoneNo',
        'BankAccNo',
        'BankAccDetails',
        'LanguageId',
        'TaxRatePnL',
        'FolioPNL',
        'FolioPNL_Desc',
    ];

    // Helpful casts (tweak precision as needed)
    protected $casts = [
        'IsActive'       => 'boolean',
        'LanguageId'     => 'integer',
        'TaxPercentage'  => 'decimal:4',
        'TaxRatePnL'     => 'decimal:4',
    ];

    /* ---------- Scopes ---------- */

    public function scopeActive($query)
    {
        return $query->where('IsActive', 1);
    }
}
