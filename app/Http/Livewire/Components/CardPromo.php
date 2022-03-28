<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\Promo;

class CardPromo extends Component
{
    public function render()
    {
        $promos = Promo::all();
        return view('livewire.components.card-promo', ['promos'=> $promos]);
    }
}
