<?php

namespace App\Livewire;

use App\Models\Costumer;
use App\Models\Product;
use Filament\Actions\Action;
use Livewire\Component;
use Filament\Forms\Components\{Textinput, Select, Button, Table};
use Filament\Forms\Components\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Columns\TextColumn;

class SalesForm extends Component
{
    use InteractsWithForms;
    public $id_costumer;
    public $items = [];
    public $showProductModal = false;
    public $showQuantityModal = false;
    public $selectedProduct = null;
    public $id_product;
    public $products;
    public $quantity = 1;
    public $price = 0;

    public function mount(){
        $this->products = Product::all();
    }
    
    public function OpenQuantityModal($code_product) {
        $this->selectedProduct = Product::find($code_product);
        $this->price = $this->selectedProduct->pricwe;
        $this->showQuantityModal = $this->showQuantityModal = true;
    }

    public function addItem(){
        if(!$this->selectedProduct) return;

        $this->items[] = [
            'id_product' => $this->selectedProduct->id,
            'product_name' => $this->selectedProduct->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];

        $this->reset(['selectedProduct', 'quantity', 'price', 'showQuantityModal']);
    }

    public function saveSales(){
        //
    }

    public function render()
    {
        return view('livewire.sales-form');
    }
}
