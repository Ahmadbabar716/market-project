<?php

namespace App\Filament\Pages;

use App\Models\Product;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class FeaturedProducts extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Featured Products';

    protected static ?string $title = 'Manage Featured Products';

    public function getView(): string
    {
        return 'filament.pages.featured-products';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()->where('featured', true)->orderBy('sort_order')
            )
            ->columns([
                ImageColumn::make('image')
                    ->size(80)
                    ->circular()
                    ->defaultImageUrl(url('placeholder.png')),
                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold')
                    ->size('lg'),
                TextColumn::make('price')
                    ->money('USD')
                    ->weight('semibold')
                    ->size('lg'),
                TextColumn::make('description')
                    ->limit(50)
                    ->wrap(),
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->weight('bold'),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('edit_product')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->color('primary')
                    ->url(fn (Product $record): string => route('filament.admin.resources.products.edit', $record)),

                \Filament\Actions\Action::make('remove_featured')
                    ->label('Remove')
                    ->icon('heroicon-o-star')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Remove from Featured')
                    ->modalDescription('Are you sure you want to remove this product from the featured section?')
                    ->action(function (Product $record) {
                        $record->update(['featured' => false]);
                        Notification::make()
                            ->title('Product removed from featured')
                            ->success()
                            ->send();
                    }),
            ])
            ->emptyStateHeading('No featured products yet')
            ->emptyStateDescription('Use the "Add to Featured" button above to add products to the featured section.')
            ->emptyStateIcon('heroicon-o-star');
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('add_to_featured')
                ->label('Add Product to Featured')
                ->icon('heroicon-o-plus-circle')
                ->color('success')
                ->form([
                    Select::make('product_id')
                        ->label('Select Product')
                        ->options(
                            Product::where('featured', false)
                                ->where('active', true)
                                ->pluck('name', 'id')
                        )
                        ->searchable()
                        ->required()
                        ->placeholder('Search for a product...'),
                ])
                ->action(function (array $data) {
                    $product = Product::find($data['product_id']);
                    if ($product) {
                        $maxOrder = Product::where('featured', true)->max('sort_order') ?? 0;
                        $product->update([
                            'featured' => true,
                            'sort_order' => $maxOrder + 1,
                        ]);
                        Notification::make()
                            ->title("'{$product->name}' added to featured products!")
                            ->success()
                            ->send();
                    }
                }),

            Action::make('manage_all_products')
                ->label('All Products')
                ->url(route('filament.admin.resources.products.index'))
                ->icon('heroicon-o-shopping-bag')
                ->color('gray'),
        ];
    }
}
