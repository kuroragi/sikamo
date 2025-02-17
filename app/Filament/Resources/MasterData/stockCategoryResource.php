<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\stockCategoryResource\Pages;
use App\Filament\Resources\MasterData\stockCategoryResource\RelationManagers;
use App\Models\stockCategory;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
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
