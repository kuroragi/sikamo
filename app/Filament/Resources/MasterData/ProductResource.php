<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\ProductResource\Pages;
use App\Filament\Resources\MasterData\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\StockCategory;
use App\Models\Unit;
use App\Models\UnitConvertion;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
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
                    ->label('Kategori')
                    ->live()
                    ->options(StockCategory::pluck('name', 'id'))
                    ->preload()
                    ->required(),
                Select::make('id_unit')
                    ->options(fn(Get $get): Collection => UnitConvertion::query()
                        ->with(['unit' => function($query){
                            $query->select(['id', 'name'])->orderBy('name');
                        }])
                        ->where('id_category', $get('id_category'))
                        ->orderBy('is_main', 'desc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->unit->id => $item->unit->name])
                    )
                    ->searchable()
                    ->reactive()
                    ->required(),
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
                    ->alignEnd(),
                //     ->formatStateUsing(fn(string $state):string => str_replace(',', '.', number_format($state))),
                TextColumn::make('selling_price')
                    ->label('Harga Jual')
                    ->alignEnd(),
                //     ->formatStateUsing(fn(string $state):string => str_replace(',', '.', number_format($state))),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('main_unit.name')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
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
