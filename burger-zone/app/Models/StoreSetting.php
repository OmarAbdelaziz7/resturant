<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $table = 'store_settings';

    protected $fillable = [
        'store_name',
        'store_location',
        'store_phone',
        'store_email',
        'store_description',
    ];

    /**
     * Get the first store setting or create a default one
     */
    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'store_name' => 'Burger Zone',
                'store_location' => '',
                'store_phone' => '',
                'store_email' => '',
                'store_description' => '',
            ]
        );
    }
}
