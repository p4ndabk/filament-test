<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()->label('Nome'),

                Forms\Components\TextInput::make('username')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('document')
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('(00)00000-0000'))
                    ->required(),

                Forms\Components\TextInput::make('address')
                    ->required(),

                Forms\Components\TextInput::make('address_number')
                    ->required(),

                Forms\Components\Toggle::make('active')
                
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),

                Tables\Columns\TextColumn::make('username'),
                
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('document'),
                Tables\Columns\TextColumn::make('phone'),
                    
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('address_number'),
                Tables\Columns\ToggleColumn::make('active'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y') ,
            ])
            ->filters([
                TernaryFilter::make('is_admin')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomers::route('/'),
        ];
    }    
}
