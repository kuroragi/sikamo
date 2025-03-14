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
    
    public function OpenQuantityModal($code_product) {
        $this->selectedProduct = Product::find($code_product);
        $this->selling_price = $this->selectedProduct->selling_price;
        $this->showQuantityModal = $this->showQuantityModal = true;
    }

    #[On('id_product')]
    public function updateSelectedProduct($id_product){
        $this->id_product = $id_product;
        $product = Product::findOrFail($this->id_product);
        if($product){
            dd($product);
            $this->selling_price = $product->selling_price;
        }
    }

    public function addItem(){
        // if(!$this->selectedProduct) return;
        $item = Product::findOrFail($this->id_product);

        $this->items[] = [
            'id_product' => $this->id_product,
            'product_name' => $item->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];

        $this->reset(['quantity', 'price']);
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
