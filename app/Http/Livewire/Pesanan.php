<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Pesanan as Pesan;

class Pesanan extends Component
{
    public $pesanans;

    public function render()
    {
        if (Auth::user()) {
            $this->pesanans = Pesan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();
        }
        return view('livewire.pesanan');
    }
}
