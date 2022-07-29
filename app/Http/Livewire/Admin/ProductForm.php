<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Component;

class ProductForm extends Component
{
    public $product;

    public $item;
    public $description;
    public $qty;
    public $unit;
    public $category;
    
    public $units = [];
    public $categories = [];

    protected $rules = [
        'item' => 'required',
        'description' => 'required',
        'qty' => 'required',
        'unit' => 'required',
        'category' => 'required'
    ];

    protected $listeners = [
        'editProduct',
        'newProduct' => 'resetInput',
        'deleteProduct'
    ];

    public function render()
    {
        return view('livewire.admin.product-form');
    }

    public function editProduct(Product $product) {
        $this->product = $product;
        $this->item = $product->item;
        $this->description = $product->description;
        $this->qty = $product->qty;
        $this->unit = $product->unit;
        $this->category = $product->category;
    }

    public function submitForm(ProductService $productService) {
        $validatedData = $this->validate();
        if ($this->product) {
            $productService->update($this->product, $validatedData);
            $this->emit('productUpdated');
        } else {
            $productService->create(auth()->user(), $validatedData + ['status_id' => status_pending_id()]);
            $this->emit('productCreated');
        }
        $this->resetInput();
    }

    public function resetInput() {
        $this->item = null;
        $this->description = null;
        $this->qty = null;
        $this->unit = null;
        $this->category = null;
    }

    public function deleteProduct(Product $product, ProductService $productService) {
        $productService->delete($product);
        $this->emit('productDeleted');
    }
}
