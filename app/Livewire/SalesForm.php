<?php

namespace App\Livewire;

use App\Models\Costumer;
use App\Models\Product;

use Livewire\Component;
use Filament\Forms\Components\{Textinput, Select, Table, Button};

class SalesForm extends Component
{
    public $id_costumer;
    public $items = [];
    public $id_product;
    public $quantity;
    public $price;

    protected function getFormSchema(): array{
        return [
            Select::make('id_costumer')
                ->label('Kostumer')
                ->nullable()
                ->options(Costumer::pluck('name', 'id')),
            Select::make('id_product')
                ->label('Product')
                ->required(),
        ];
    }

    public function render()
    {
        return view('livewire.sales-form');
    }
}
