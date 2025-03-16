<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\SaleResource\Pages;
use App\Filament\Resources\MasterData\SaleResource\RelationManagers;
use App\Models\Costumer;
use App\Models\Product;
use App\Models\Sale;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\Concerns\HasForm;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_costumer')
                    ->label('Pelanggan')
                    ->relationship('costumer', 'name')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nik')
                            ->label('NIK')
                            ->numeric()
                            ->maxLength(18)
                            ->required(),
                        TextInput::make('name')
                            ->label('Nama Pelanggan')
                            ->required(),
                        TextInput::make('phone')
                            ->label('No. Hp'),
                        TextInput::make('email')
                            ->email(),
                    ]),
                Textarea::make('keterangan')
                    ->nullable(),
                DatePicker::make('date_sale')
                    ->displayFormat('d-m-Y')
                    ->required(),
                // Actions::make([
                //     Action::make('items')
                //         ->label('Pilih Item')
                //         ->modalHeading('Daftar Produk')
                //         ->modalContent(fn(): View => view('pages.sales_product_form'))
                // ])
                //         ->verticalAlignment(VerticalAlignment::End)
                //         ->fullWidth(),
                Repeater::make('sale_details')
                    ->relationship()
                    ->schema([
                        Grid::make(12)
                        ->schema([
                            Select::make('id_product')
                                ->label('Produk')
                                ->relationship('product', 'name')
                                ->required()
                                ->live()
                                ->preload()
                                ->afterStateUpdated(function($state, callable $set) {
                                    $selling_price = Product::find($state)?->selling_price ?? 0;
                                    $set('selling_price', $selling_price);
                                    $set('sub_total', $selling_price);
                                })->columnSpan(3),
                            TextInput::make('quantity')
                                ->label('Jumlah')
                                ->numeric()
                                ->default(1)
                                ->required()
                                ->live()
                                ->afterStateUpdated(fn($state, callable $get, callable $set) =>
                                    $set('sub_total', $state * $get('selling_price'))
                                )->columnSpan(2),
                            TextInput::make('selling_price')
                                ->label('Harga')
                                ->numeric()
                                ->default(0)
                                ->required()
                                ->columnSpan(3),
                            TextInput::make('sub_total')
                                ->label('Total')
                                ->numeric()
                                ->disabled()
                                ->default(0)
                                ->columnSpan(3),
                            // Actions::make([
                            //     Action::make('delete')
                            //         ->label('Hapus')
                            //         ->color('danger')
                            //         ->action(fn($state, $record) => $record->delete())
                            // ])->columnSpan(1)
                        ])
                    ])
                    ->minItems(1)
                    ->addActionLabel('Tambah Produk')
                    ->columnSpanFull(),
                        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
