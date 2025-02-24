<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\stockCategoryResource\Pages;
use App\Filament\Resources\MasterData\stockCategoryResource\RelationManagers;
use App\Models\stockCategory;
use App\Models\Unit;
use Filament\Forms;
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

class stockCategoryResource extends Resource
{
    protected static ?string $model = stockCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Master Data';

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
                    ->button()
                    ->outlined()
                    ->modalHeading('Konversi Unit')
                    ->modalContent(fn(stockCategory $record): View => view('filament.tables.modals.units', [
                        'record' => $record
                    ]))
                    ->extraModalFooterActions(
                        [
                            Action::make('unit')
                            ->label('Tambah Konversi Unit')
                            ->form([
                                Select::make('name')
                            ])
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
