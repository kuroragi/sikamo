<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\ProductResource\Pages;
use App\Filament\Resources\MasterData\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Data Product';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code_product')
                    ->label('Kode Product')
                    ->nullable(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_buy')
                    ->label('Harga Beli Terakhir')
                    ->numeric()
                    ->default(0),
                TextInput::make('selling_price')
                    ->label('Harga Jual')
                    ->numeric()
                    ->default(0),
                Select::make('id_category')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('id_unit')
                    ->relationship('unit', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('no')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('last_buy')
                    ->label('Harga Beli Terakhir')
                    ->alignEnd()
                    ->formatStateUsing(fn(string $state):string => str_replace(',', '.', number_format($state))),
                TextColumn::make('selling_price')
                    ->label('Harga Jual')
                    ->alignEnd()
                    ->formatStateUsing(fn(string $state):string => str_replace(',', '.', number_format($state))),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('main_unit.name')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Action::make('units')
                //     ->label('Check Unit')
                //     ->icon('heroicon-o-tag')
                //     ->modalHeading('Satuan')
                //     ->modalContent(function(Product $record){
                //         return $record;
                //     })
                //     ->action(function(array $data): void{
                //         //
                //     })
                //     ->slideOver(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    // protected static function getSatuanTable(Product $record){
    //     return Table::make()
    //         ->columns([
    //             TextColumn::make('satuans.name')
    //                 ->label('Nama Satuan'),
    //         ])
    //         ->query($record->)
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
