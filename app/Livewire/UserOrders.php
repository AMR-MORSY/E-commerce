<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.user-account')]
class UserOrders extends Component
{
    public function render()
    {
        $orders=Auth::user()->orders()->get();
        return view('livewire.user-orders',compact('orders'));
    }
}
