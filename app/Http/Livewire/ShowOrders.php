<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class ShowOrders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::with('products')->OrderBy('id', 'desc')->get();
    }

    public function render()
    {
        // dd($this->orders->toArray());

        return view('livewire.show-orders');
    }
}
