<?php

namespace App\Livewire\Forms;

use App\Models\StockCategory;
use App\Models\UnitConvertion;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Livewire\Component;

class StockForm extends Component
{
    public $id_category;
    public $id_unit;

    public function render()
    {
        return view('livewire.forms.stock-form');
    }

    public function form(Form $form): Form {
        return $form
                ->schema([
                    Select::make('id_category')
                        ->label('Kategori')
                        ->live()
                        ->options(StockCategory::pluck('name', 'id'))
                        ->preload()
                        ->required()
                        ->afterStateUpdated(fn($state) => $this->updateIdCategory($state)),
                    Select::make('id_unit')
                        ->label('Satuan')
                        ->options(fn() => $this->getUnitsOptions())
                        ->required(),
                ]);
    }

    public function updateIdCategory($value){
        $this->id_category = $value;
    }

    public function getUnitsOptions(){
        return UnitConvertion::where('id_category', $this->id_category)
                ->pluck('id_unit', 'id')
                ->toArray();
    }
}
