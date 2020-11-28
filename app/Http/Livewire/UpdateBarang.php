<?php

namespace App\Http\Livewire;

use App\Liga;
use App\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateBarang extends Component
{
    use WithFileUploads;

    public $product;
    public $nama;
    public $harga;
    public $harga_nameset;
    public $liga_id;
    public $berat;
    public $gambar, $kode;

    public function updatedPhoto()
    {
        $this->validate([
            'gambar' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function mount($id)
    {
        $getProduk = Product::find($id);
        $this->kode = $id;
        if ($getProduk) {
            $this->product = $getProduk;
            $this->nama = $getProduk->nama;
            $this->harga = $getProduk->harga;
            $this->harga_nameset = $getProduk->harga_nameset;
            $this->liga_id = $getProduk->liga_id;
            $this->berat = $getProduk->berat * 1000;
        }
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'harga_nameset' => 'required|numeric',
            'liga_id' => 'required',
            'berat' => 'required|numeric',
        ]);
        if ($this->gambar) {
            $filename = "jer" . time() . '.' . $this->gambar->extension();
            $this->gambar->storeAs("jersey", $filename);
        } else {
            $filename = $this->product->gambar;
        }
        $data = [
            'nama' => $this->nama,
            'harga' => $this->harga,
            'harga_nameset' => $this->harga_nameset,
            'liga_id' => $this->liga_id,
            'berat' => $this->berat / 1000,
            'gambar' => $filename,
        ];
        $upp = Product::where("id", $this->kode)->update($data);
        if ($upp) {
            session()->flash('message', 'Berhasil Mengubah Barang!');
            return redirect()->route("products");
        }
    }

    public function render()
    {
        return view('livewire.update-barang', [
            'ligas' => Liga::all(),
            "product" => $this->product,
        ]);
    }
}
