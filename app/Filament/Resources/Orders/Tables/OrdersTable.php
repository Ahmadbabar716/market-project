<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order #')->searchable(),
                TextColumn::make('customer_name')->label('Customer')->searchable(),
                TextColumn::make('customer_phone')->label('Phone')->searchable(),
                TextColumn::make('total_amount')->label('Total')->formatStateUsing(fn ($state) => 'Rs.' . number_format($state, 2)),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    }),
                TextColumn::make('created_at')->label('Date')->dateTime('M j, Y h:i A'),
            ])
            ->recordActions([
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(function (Order $record) {
                        $phone = preg_replace('/[^0-9]/', '', $record->customer_phone);
                        if (str_starts_with($phone, '0')) {
                            $phone = '92' . substr($phone, 1);
                        } elseif (!str_starts_with($phone, '92')) {
                            $phone = '92' . $phone;
                        }
                        
                        $message = "*🛒 Zafarwal Mandi - Order Confirmation*\n\n";
                        $message .= "Hello *{$record->customer_name}*,\n";
                        $message .= "Thank you for your order #{$record->id}!\n\n";
                        $message .= "*Order Details:*\n";
                        foreach ($record->items as $item) {
                            $message .= "- {$item->product_name} ({$item->quantity} {$item->unit}): Rs.{$item->subtotal}\n";
                        }
                        $message .= "\n*Total: Rs.{$record->total_amount}*\n";
                        $message .= "\nWe are preparing your order. We will notify you once it's shipped.";
                        
                        return "https://wa.me/{$phone}?text=" . urlencode($message);
                    })
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
