<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\stockCategoryResource\Pages;
use App\Filament\Resources\MasterData\stockCategoryResource\RelationManagers;
use App\Models\stockCategory;
use App\Models\Unit;
use App\Models\UnitConvertion;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class stockCategoryResource extends Resource
{
    protected static ?string $model = stockCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Data Product';

    protected $listener = ['testing'];

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex(),
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('units')
                    ->label('Unit')
                    ->icon('heroicon-o-magnifying-glass')
                    ->color('info')
                    ->modalHeading('Konversi Unit')
                    ->modalContent(fn(stockCategory $record): View => view('filament.tables.modals.units', [
                        'record' => $record->load(['unit'])
                    ]))
                    ->extraModalFooterActions(
                        [
                            Action::make('unit')
                            ->label('Tambah Konversi Unit')
                            ->form([
                                Select::make('id_unit')
                                    ->label('Satuan')
                                    ->options(Unit::pluck('name', 'id'))
                                    ->required(),
                                TextInput::make('kali_utama')
                                    ->label('Kali Utama Satuan')
                                    ->required()
                                    ->numeric(),
                                Checkbox::make('is_main')
                                    ->label('Satuan Utama?')
                                    ->default(false),
                            ])
                            ->mutateFormDataUsing(function(array $data, stockCategory $record){
                                $data['id_category'] = $record->id;
                                return $data;
                            })
                            ->action(function(array $data, stockCategory $record){
                                UnitConvertion::create($data);
                            })
                            ->modalSubmitActionLabel('Tambahkan Unit')
                            ->successNotificationTitle('Berhasil Menambahkan unit konversi')
                        ]
                    ),
                    // ->modalContent(function(stockCategory $record){
                    //     view('filament.tables.modals.units', ['record' => $record]);
                    // }),
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
            'index' => Pages\ListstockCategories::route('/'),
            'create' => Pages\CreatestockCategory::route('/create'),
            'edit' => Pages\EditstockCategory::route('/{record}/edit'),
        ];
    }

    public function testing(){
        dd('testing');
    }
}
