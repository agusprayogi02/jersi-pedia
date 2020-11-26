<?php

namespace App\Http\Livewire;

use App\Liga;
use App\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TambahBarang extends Component
{

    use WithFileUploads;

    public $nama;
    public $harga;
    public $harga_nameset;
    public $liga_id;
    public $berat;
    public $gambar;

    public function updatedPhoto()
    {
        $this->validate([
            'gambar' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function tambahBarang()
    {
        $this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'harga_nameset' => 'required|numeric',
            'liga_id' => 'required',
            'berat' => 'required|numeric',
            'gambar' => 'required|image|max:1024', // 1MB Max
        ]);
        $filename = "jer" . time() . '.' . $this->gambar->extension();
        $this->gambar->storeAs("jersey", $filename);
        $upp = Product::insert([
            'nama' => $this->nama,
            'harga' => $this->harga,
            'harga_nameset' => $this->harga_nameset,
            'liga_id' => $this->liga_id,
            'berat' => $this->berat / 1000,
            'gambar' => $filename,
        ]);
        if ($upp) {
            session()->flash('message', 'Berhasil Menambahkan Barang!');
            return redirect()->route("products");
        }
    }

    public function render()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        return view('livewire.tambah-barang', [
            'ligas' => Liga::all(),
        ]);
    }
}
