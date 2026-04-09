<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                Select::make('type')
                    ->options(['percentage' => 'Percentage', 'fixed' => 'Fixed'])
                    ->required(),
                TextInput::make('value')
                    ->required()
                    ->numeric(),
                TextInput::make('min_order')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('max_uses')
                    ->numeric()
                    ->default(null),
                TextInput::make('used_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
                DatePicker::make('expires_at'),
            ]);
    }
}
