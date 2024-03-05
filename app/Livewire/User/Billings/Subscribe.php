<?php

namespace App\Livewire\User\Billings;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\Subscription;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class Subscribe extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Subscription::where('user_email', auth()->user()->email);
            })
            ->columns([
                TextColumn::make('product_name')
                    ->label('Product'),
                TextColumn::make('user_name')
                    ->label('User Name'),
                TextColumn::make('user_email')
                    ->label('User Email'),
                TextColumn::make('status')
                    ->badge()
                    ->label('Status'),
                IconColumn::make('cancelled')
                    ->boolean(),
                TextColumn::make('card_brand')
                    ->label('Card'),
                TextColumn::make('renews_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ends_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.user.billings.subscribe');
    }
}
