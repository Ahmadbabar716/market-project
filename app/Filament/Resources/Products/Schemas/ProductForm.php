<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->rows(3),
                Select::make('unit')
                    ->label('Unit')
                    ->options([
                        'kg' => 'Kilograms (kg)',
                        'dozen' => 'Dozen (Dargeen)',
                        'piece' => 'Piece',
                        'gm' => 'Grams (gm)',
                    ])
                    ->required()
                    ->default('kg'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                Toggle::make('featured')
                    ->label('Featured Product')
                    ->helperText('Show this product in featured section'),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
                Toggle::make('active')
                    ->label('Active')
                    ->helperText('Enable/disable this product'),
            ]);
    }
}
