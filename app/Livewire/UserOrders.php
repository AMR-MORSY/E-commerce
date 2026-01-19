<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user-account')]
class UserOrders extends Component
{
    public function render()
    {
        return view('livewire.user-orders');
    }
}
