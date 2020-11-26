<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;
    public $search;

    protected $updateQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $del = Product::where('id', $id)->delete();
        if ($del) {
            session()->flash("message", "Berhasil Menghapus Barang!");
        }
    }

    public function render()
    {
        if ($this->search) {
            $products = Product::where('nama', 'like', '%' . $this->search . '%')->paginate(8);
        } else {
            $products = Product::orderBy('id', 'desc')->paginate(8);
        }

        return view('livewire.product-index', [
            'products' => $products,
            'title' => 'List Jersey'
        ]);
    }
}
