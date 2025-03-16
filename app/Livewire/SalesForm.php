<?php

namespace App\Livewire;

use App\Models\Costumer;
use App\Models\Product;
use Filament\Actions\Action;
use Livewire\Component;
use Filament\Forms\Components\{Textinput, Select, Button, Table};
use Filament\Forms\Components\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Livewire\Attributes\On;

class SalesForm extends Component implements HasForms
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
    public $selling_price = 0;
    public $unit;
    public $listeners = ['updateSelectedProduct'];

    public function mount(){
        $this->products = Product::all();
    }

    #[On('id_product')]
    public function updatedIdProduct(){
        $this->selectedProduct = Product::findOrFail($this->id_product);
        if($this->selectedProduct){
            $this->selling_price = $this->selectedProduct->selling_price;
        }
    }

    #[On('quantity')]
    public function updatedQuantity(){
        $this->selling_price = $this->selectedProduct->selling_price * $this->quantity;
    }

    public function addItem(){
        // if(!$this->selectedProduct) return;
        $item = Product::findOrFail($this->id_product);

        $this->items[] = [
            'id_product' => $this->id_product,
            'product_name' => $this->selectedProduct->name,
            'quantity' => $this->quantity,
            'selling_price' => $this->selling_price,
        ];

        $this->reset(['quantity', 'selling_price']);
    }

    public function saveSales(){
        //
    }

    public function render()
    {
        $data['selected_items'] = $this->items; 
        return view('livewire.sales-form', $data);
    }
}
