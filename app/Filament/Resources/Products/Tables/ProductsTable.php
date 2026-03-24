<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->size(60)
                    ->circular()
                    ->defaultImageUrl(url('placeholder.png')),
                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('price')
                    ->sortable()
                    ->weight('semibold')
                    ->formatStateUsing(fn ($state) => 'Rs.' . number_format($state, 2)),
                TextColumn::make('unit')
                    ->label('Unit')
                    ->badge()
                    ->color('info'),
                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('gray'),
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('featured')
                    ->label('Featured Products'),
                TernaryFilter::make('active')
                    ->label('Active Status'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
