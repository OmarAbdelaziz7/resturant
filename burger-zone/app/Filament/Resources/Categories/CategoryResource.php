<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Models\Category;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use BackedEnum;
class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';
public static function form(Schema $schema): Schema
{
    return $schema
        ->schema([
            Schemas\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => 
                    $set('slug', Str::slug($state))),

            Schemas\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Schemas\Components\FileUpload::make('image')
                ->image()
                ->directory('categories')
                ->columnSpanFull(),

            Schemas\Components\Toggle::make('is_active')
                ->default(true),

            Schemas\Components\TextInput::make('sort_order')
                ->numeric()
                ->default(0),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->circular(),

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('products_count')
                ->counts('products')
                ->sortable(),

            Tables\Columns\ToggleColumn::make('is_active'),

            Tables\Columns\TextColumn::make('sort_order')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->date('d/m/Y')
                ->sortable(),
        ])
        ->defaultSort('sort_order')
        ->filters([
            Tables\Filters\TernaryFilter::make('is_active'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
